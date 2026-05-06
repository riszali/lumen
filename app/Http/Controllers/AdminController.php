<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Banner;
use App\Models\Brand; // <-- TAMBAHAN INI
use App\Models\Subscriber;
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
        $products = Product::with('category', 'primaryImage')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        // 1. Cek Kategori Baru (Mencegah Error 500 Duplicate Entry)
        if ($request->filled('new_category_name')) {
            $newCategory = Category::firstOrCreate(
                ['slug' => Str::slug($request->new_category_name)],
                ['name' => $request->new_category_name]
            );
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

        // 3. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'specification' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'primary_image_index' => 'nullable|integer'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        // 4. Proses Upload Multiple Image dengan Primary Index Check
        if ($request->hasFile('images')) {
            $primaryIndex = $request->input('primary_image_index', 0);
            
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => ((int)$index === (int)$primaryIndex) 
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function productsEdit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, Product $product)
    {
        // 1. Cek Kategori Baru (Mencegah Error 500 Duplicate Entry)
        if ($request->filled('new_category_name')) {
            $newCategory = Category::firstOrCreate(
                ['slug' => Str::slug($request->new_category_name)],
                ['name' => $request->new_category_name]
            );
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

        // 3. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'specification' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'primary_image_id' => 'nullable|exists:product_images,id',
            'primary_image_index' => 'nullable|integer'
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        // 4. Proses Gambar (Update / Upload Baru)
        if ($request->hasFile('images')) {
            // Jika ada gambar baru diupload, hapus semua yang lama
            foreach ($product->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->delete();
            }

            $primaryIndex = $request->input('primary_image_index', 0);
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => ((int)$index === (int)$primaryIndex)
                ]);
            }
        } else {
            // Jika tidak ada upload baru, tapi user klik gambar lama untuk jadi primary
            if ($request->filled('primary_image_id')) {
                // Reset semua is_primary ke false
                $product->images()->update(['is_primary' => false]);
                // Set yang diklik jadi true
                $product->images()->where('id', $request->primary_image_id)->update(['is_primary' => true]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
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

    // FUNGSI INI YANG KEMARIN KETINGGALAN
    public function subscribersIndex()
    {
        $subscribers = Subscriber::latest()->paginate(15);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    // --- TAMBAHAN FUNGSI MANAJEMEN BRAND DI PALING BAWAH ---
    public function brandsIndex()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function brandsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'banner' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        $bannerPath = $request->file('banner')->store('brands/banners', 'public');
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('brands/logos', 'public') : null;

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo_path' => $logoPath,
            'banner_path' => $bannerPath,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return back()->with('success', 'Brand beserta logo dan banner berhasil ditambahkan.');
    }

    public function brandsDestroy(Brand $brand)
    {
        if ($brand->banner_path) {
            Storage::disk('public')->delete($brand->banner_path);
        }
        if ($brand->logo_path) {
            Storage::disk('public')->delete($brand->logo_path);
        }
        $brand->delete();

        return back()->with('success', 'Brand berhasil dihapus.');
    }
}