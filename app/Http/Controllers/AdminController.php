<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Subscriber;
use App\Models\Voucher;
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
        
        // Hanya menghitung pendapatan dari pesanan yang sudah selesai/lunas
        $revenue = Order::where('status', 'completed')->sum('total_amount');
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $activePromos = Voucher::where('is_active', true)->count(); // Menghitung voucher aktif

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'revenue', 'recentOrders', 'activePromos'));
    }

    // =========================================================================
    // 1. MANAJEMEN PRODUK (CATALOG MANAGEMENT)
    // =========================================================================

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

    /**
     * Menyimpan data produk baru ke database termasuk multi-image upload & diskon.
     */
    public function productsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'new_brand_name' => 'nullable|string|max:255',
            'description' => 'required',
            'specification' => 'nullable',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price', // Diskon ga boleh lebih besar dari harga asli
            'flash_sale_price' => 'nullable|numeric|min:0|lt:price',
            'flash_sale_start_date' => 'nullable|date',
            'flash_sale_end_date' => 'nullable|date|after_or_equal:flash_sale_start_date',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240' // Max 10MB per gambar
        ]);

        // Logika untuk menangani input Kategori Baru secara langsung
        $categoryId = $request->category_id;
        if ($request->filled('new_category_name')) {
            $newCat = Category::create([
                'name' => $request->new_category_name,
                'slug' => Str::slug($request->new_category_name)
            ]);
            $categoryId = $newCat->id;
        }

        // Logika untuk menangani input Brand Baru secara langsung
        $brandName = $request->brand;
        if ($request->filled('new_brand_name')) {
            $brandName = $request->new_brand_name;
        }

        // PENGAMAN DISKON: Jika diskon 0 atau kosong, ubah jadi null agar tidak jadi produk gratis
        $discountPrice = ($request->discount_price > 0) ? $request->discount_price : null;
        $flashSalePrice = ($request->flash_sale_price > 0) ? $request->flash_sale_price : null;

        // Membuat record produk utama
        $product = Product::create([
            'category_id' => $categoryId,
            'brand' => $brandName,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'discount_price' => $discountPrice, // Variabel yang sudah diamankan
            'flash_sale_price' => $flashSalePrice,
            'flash_sale_start_date' => $request->flash_sale_start_date,
            'flash_sale_end_date' => $request->flash_sale_end_date,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        // Menyimpan banyak gambar sekaligus dan set mana yang jadi Primary
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => ((string)$request->primary_image_index === (string)$index)
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan ke katalog.');
    }

    /**
     * Membuka form edit untuk produk yang sudah ada.
     */
    public function productsEdit(Product $product)
    {
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk dan mengelola perubahan gambar / diskon.
     */
    public function productsUpdate(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'flash_sale_price' => 'nullable|numeric|min:0|lt:price',
            'flash_sale_start_date' => 'nullable|date',
            'flash_sale_end_date' => 'nullable|date|after_or_equal:flash_sale_start_date',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        // LOGIKA KATEGORI BARU 
        $categoryId = $request->category_id;
        if ($request->filled('new_category_name')) {
            $newCat = Category::create([
                'name' => $request->new_category_name,
                'slug' => Str::slug($request->new_category_name)
            ]);
            $categoryId = $newCat->id;
        }

        // Mencegah error "1048 Column 'category_id' cannot be null"
        if (!$categoryId) {
            $categoryId = $product->category_id; 
        }

        // PENGAMAN DISKON: Jika diskon 0 atau kosong, ubah jadi null agar tidak jadi produk gratis
        $discountPrice = ($request->discount_price > 0) ? $request->discount_price : null;
        $flashSalePrice = ($request->flash_sale_price > 0) ? $request->flash_sale_price : null;

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $categoryId,
            'brand' => $request->filled('new_brand_name') ? $request->new_brand_name : $request->brand,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'discount_price' => $discountPrice, // Variabel yang sudah diamankan
            'flash_sale_price' => $flashSalePrice,
            'flash_sale_start_date' => $request->flash_sale_start_date,
            'flash_sale_end_date' => $request->flash_sale_end_date,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        // Logika 1: Jika admin mengupload gambar baru (MENGGANTI TOTAL)
        if ($request->hasFile('images')) {
            // Hapus gambar lama dari storage & database
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
            }
            $product->images()->delete();

            // Masukkan gambar baru dan set primary berdasarkan pilihan
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => ((string)$request->primary_image_index === (string)$index)
                ]);
            }
        } 
        // Logika 2: Jika admin HANYA mengubah gambar primary dari galeri yang sudah ada
        else {
            if ($request->filled('primary_image_id')) {
                // Matikan semua flag primary untuk produk ini
                $product->images()->update(['is_primary' => false]);
                
                // Nyalakan primary hanya pada gambar yang dipilih admin
                $product->images()->where('id', $request->primary_image_id)->update(['is_primary' => true]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk beserta file gambar terkait dari storage.
     */
    public function productsDestroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Produk telah dihapus dari sistem.');
    }

    // =========================================================================
    // 2. MANAJEMEN PESANAN (ORDER MANAGEMENT)
    // =========================================================================

    /**
     * Menampilkan daftar pesanan masuk dari pelanggan.
     */
    public function ordersIndex()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Memperbarui status pesanan (misal: dari Paid ke Shipped).
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan #' . $order->order_number . ' diperbarui.');
    }

    // =========================================================================
    // 3. MANAJEMEN BANNER HOME (SHOWCASE CAROUSEL)
    // =========================================================================

    /**
     * Menampilkan daftar banner di halaman depan.
     */
    public function bannersIndex()
    {
        $banners = Banner::latest()->get();
        
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Mengunggah banner baru.
     */
    public function bannersStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'title' => 'nullable|string|max:255'
        ]);

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $request->title,
            'image_path' => $path,
            'is_active' => true
        ]);

        return back()->with('success', 'Banner promosi berhasil diunggah.');
    }

    /**
     * Menghapus banner.
     */
    public function bannersDestroy(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        
        $banner->delete();
        
        return back()->with('success', 'Banner berhasil dihapus.');
    }

    // =========================================================================
    // 4. MANAJEMEN BRAND (HALAMAN KHUSUS MERK)
    // =========================================================================

    /**
     * Menampilkan daftar halaman Brand.
     */
    public function brandsIndex()
    {
        $brands = Brand::latest()->get();
        
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Membuat halaman khusus brand baru (beserta logo dan banner).
     */
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

        return back()->with('success', 'Halaman brand berhasil dibuat.');
    }

    /**
     * Membuka form edit halaman brand.
     */
    public function brandsEdit(Brand $brand)
    {
        // Menarik semua data brand agar menu navigasi sidebar admin tidak error (Undefined variable $brands)
        $brands = Brand::latest()->get(); 
        
        return view('admin.brands.edit', compact('brand', 'brands'));
    }

    /**
     * Memperbarui informasi brand, logo, atau bannernya.
     */
    public function brandsUpdate(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        // Cek jika admin upload banner baru
        if ($request->hasFile('banner')) {
            if ($brand->banner_path) {
                Storage::disk('public')->delete($brand->banner_path);
            }
            $brand->banner_path = $request->file('banner')->store('brands/banners', 'public');
        }

        // Cek jika admin upload logo baru
        if ($request->hasFile('logo')) {
            if ($brand->logo_path) {
                Storage::disk('public')->delete($brand->logo_path);
            }
            $brand->logo_path = $request->file('logo')->store('brands/logos', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Konten brand berhasil diperbarui.');
    }

    /**
     * Menghapus brand.
     */
    public function brandsDestroy(Brand $brand)
    {
        if ($brand->banner_path) {
            Storage::disk('public')->delete($brand->banner_path);
        }
        
        if ($brand->logo_path) {
            Storage::disk('public')->delete($brand->logo_path);
        }
        
        $brand->delete();

        return back()->with('success', 'Halaman brand telah dihapus.');
    }

    // =========================================================================
    // 5. MANAJEMEN USER & PROFIL (USER MANAGEMENT)
    // =========================================================================

    /**
     * Menampilkan daftar semua pengguna terdaftar.
     */
    public function usersIndex()
    {
        $users = User::latest()->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Membuka halaman pengaturan Profil Akun Admin yang Sedang Login.
     */
    public function profileEdit()
    {
        $user = auth()->user();
        
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan profil dan password admin.
     */
    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed'
        ]);

        // Verifikasi password lama jika ingin mengganti dengan password baru
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok dengan catatan kami.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return back()->with('success', 'Profil administrator berhasil diperbarui.');
    }

    // =========================================================================
    // 6. MANAJEMEN SUBSCRIBERS NEWSLETTER
    // =========================================================================

    /**
     * Menampilkan daftar pelanggan newsletter.
     */
    public function subscribersIndex()
    {
        $subscribers = Subscriber::latest()->paginate(15);
        
        return view('admin.subscribers.index', compact('subscribers'));
    }

    // =========================================================================
    // 7. MANAJEMEN PROMO & VOUCHER
    // =========================================================================

    public function promosIndex()
    {
        $vouchers = Voucher::latest()->paginate(20);
        $products = Product::where('is_active', true)->get(); // Untuk dropdown select Flash Sale
        $flashSaleProducts = Product::whereNotNull('flash_sale_price')->latest()->get();

        return view('admin.promos.index', compact('vouchers', 'products', 'flashSaleProducts'));
    }

    public function flashSalesStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'flash_sale_price' => 'required|numeric|min:0',
            'flash_sale_start_date' => 'nullable|date',
            'flash_sale_end_date' => 'nullable|date|after_or_equal:flash_sale_start_date',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($request->flash_sale_price >= $product->price) {
            return back()->with('error', 'Harga Flash Sale harus lebih murah dari harga normal.');
        }

        $product->update([
            'flash_sale_price' => $request->flash_sale_price,
            'flash_sale_start_date' => $request->flash_sale_start_date,
            'flash_sale_end_date' => $request->flash_sale_end_date,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke Flash Sale.');
    }

    public function flashSalesDestroy(Product $product)
    {
        $product->update([
            'flash_sale_price' => null,
            'flash_sale_start_date' => null,
            'flash_sale_end_date' => null,
        ]);

        return back()->with('success', 'Flash Sale untuk produk ini telah dihentikan.');
    }

    public function vouchersStore(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_purchase' => $request->min_purchase ?? 0,
            'max_discount' => $request->max_discount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'usage_limit' => $request->usage_limit,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Kode voucher berhasil ditambahkan.');
    }

    public function vouchersDestroy(Voucher $voucher)
    {
        $voucher->delete();
        return back()->with('success', 'Voucher berhasil dihapus.');
    }
}