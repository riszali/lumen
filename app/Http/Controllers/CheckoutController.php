<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher; // TAMBAHAN: Model voucher
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product', 'items.variant'])
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('shop.index')->with('error', 'Keranjang Anda kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    // ==========================================================
    // LOGIKA VOUCHER
    // ==========================================================
    public function applyVoucher(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $voucher = Voucher::where('code', strtoupper($request->code))->first();

        if (!$voucher || !$voucher->isValid()) {
            return back()->with('error', 'Kode voucher tidak valid atau sudah kedaluwarsa.');
        }

        // Kalkulasi subtotal sementara untuk cek min_purchase
        $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();
        $cartTotal = $cart->items->sum(function($item) {
            // Gunakan harga efektif (Flash Sale > Diskon > Normal)
            return $item->product->effective_price * $item->quantity;
        });

        if ($voucher->min_purchase > 0 && $cartTotal < $voucher->min_purchase) {
            return back()->with('error', 'Minimal belanja untuk voucher ini adalah Rp ' . number_format($voucher->min_purchase, 0, ',', '.'));
        }

        // Simpan voucher valid ke session
        session(['applied_voucher' => $voucher]);
        return back()->with('success', 'Voucher berhasil digunakan!');
    }

    public function removeVoucher()
    {
        session()->forget('applied_voucher');
        return back()->with('success', 'Voucher telah dilepas.');
    }

    // ==========================================================
    // PROSES CHECKOUT
    // ==========================================================
    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:bank_transfer,credit_card'
        ]);

        $cart = Cart::with(['items.product', 'items.variant'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('shop.index');
        }

        // KALKULASI SUBTOTAL DARI HARGA EFEKTIF TERBARU (termasuk Flash Sale)
        $cartTotal = $cart->items->sum(function($item) {
            return $item->product->effective_price * $item->quantity;
        });

        // KALKULASI DISKON VOUCHER (Jika ada di session)
        $voucherDiscount = 0;
        if (session()->has('applied_voucher')) {
            $voucher = session('applied_voucher');
            if ($voucher->isValid() && $cartTotal >= $voucher->min_purchase) {
                if ($voucher->type === 'percentage') {
                    $calcDiscount = $cartTotal * ($voucher->value / 100);
                    // Batasi dengan max_discount jika diset
                    if ($voucher->max_discount && $calcDiscount > $voucher->max_discount) {
                        $calcDiscount = $voucher->max_discount;
                    }
                    $voucherDiscount = $calcDiscount;
                } else {
                    $voucherDiscount = $voucher->value;
                }
            }
        }

        // Pastikan total tidak minus
        $finalTotal = max(0, $cartTotal - $voucherDiscount);

        DB::beginTransaction();
        try {
            // Create Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'WSP-' . strtoupper(Str::random(8)),
                'total_amount' => $finalTotal, // Pakai total yang sudah dipotong voucher
                'status' => 'pending',
                'shipping_address' => $request->address,
                'payment_method' => $request->payment_method
            ]);

            // Create Order Items and Deduct Stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->effective_price, // Amankan harga ke harga Flash Sale
                    'quantity' => $item->quantity
                ]);

                // Deduct Stock
                if ($item->product_variant_id) {
                    $item->variant->decrement('stock', $item->quantity);
                } else {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            // Jika pakai voucher, tambah used_count-nya dan hapus dari session
            if (session()->has('applied_voucher')) {
                $usedVoucher = Voucher::find(session('applied_voucher')->id);
                if ($usedVoucher) {
                    $usedVoucher->increment('used_count');
                }
                session()->forget('applied_voucher');
            }

            // Update user profile with latest phone/address if empty
            $user = Auth::user();
            if (!$user->phone) $user->update(['phone' => $request->phone]);
            if (!$user->address) $user->update(['address' => $request->address]);

            // Clear Cart
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('checkout.success', compact('order'));
    }
}