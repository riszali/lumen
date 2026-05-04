<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total_amount');
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'revenue', 'recentOrders'));
    }

    public function productsIndex()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        // 1. Cek Kategori Baru
        if ($request->filled('new_category_name')) {
            $newCategory = Category::create([
                'name' => $request->new_category_name,
                'slug' => Str::slug($request->new_category_name)
            ]);
            $request->merge(['category_id' => $newCategory->id]);
        } else {
            $request->validate(['category_id' => 'required|exists:categories,id']);
        }

        // 2. Cek Brand Baru
        if ($request->filled('new_brand_name')) {
            $request->merge(['brand' => $request->new_brand_name]);
        } else {
            $request->validate(['brand' => 'required|string|max:255']);
        }

        // 3. Validasi Data Lain
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->images()->create([
                'image_path' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function productsEdit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, Product $product)
    {
        // 1. Cek Kategori Baru
        if ($request->filled('new_category_name')) {
            $newCategory = Category::create([
                'name' => $request->new_category_name,
                'slug' => Str::slug($request->new_category_name)
            ]);
            $request->merge(['category_id' => $newCategory->id]);
        } else {
            $request->validate(['category_id' => 'required|exists:categories,id']);
        }

        // 2. Cek Brand Baru
        if ($request->filled('new_brand_name')) {
            $request->merge(['brand' => $request->new_brand_name]);
        } else {
            $request->validate(['brand' => 'required|string|max:255']);
        }

        // 3. Validasi Data Lain
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('image')) {
            if ($product->primaryImage) {
                Storage::disk('public')->delete($product->primaryImage->image_path);
                $product->primaryImage->delete();
            }

            $path = $request->file('image')->store('products', 'public');
            $product->images()->create([
                'image_path' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk diperbarui.');
    }

    public function productsDestroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus.');
    }

    public function ordersIndex()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui.');
    }

    public function usersIndex()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil dan keamanan akun berhasil diperbarui.');
    }

    // --- MANAJEMEN BANNER SHOWCASE --- //
    public function bannersIndex()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function bannersStore(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $request->title,
            'image_path' => $path,
            'is_active' => true,
        ]);

        return back()->with('success', 'Gambar banner berhasil diunggah dan akan tampil di Home.');
    }

    public function bannersDestroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return back()->with('success', 'Gambar banner berhasil dihapus.');
    }
}