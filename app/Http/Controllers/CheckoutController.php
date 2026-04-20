<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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

        DB::beginTransaction();
        try {

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'LMN-' . strtoupper(Str::random(8)),
                'total_amount' => $cart->total,
                'status' => 'pending',
                'shipping_address' => $request->address,
                'payment_method' => $request->payment_method
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity
                ]);

                if ($item->product_variant_id) {
                    $item->variant->decrement('stock', $item->quantity);
                } else {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            $user = Auth::user();
            if (!$user->phone) $user->update(['phone' => $request->phone]);
            if (!$user->address) $user->update(['address' => $request->address]);

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