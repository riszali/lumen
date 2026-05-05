<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    // Fungsi untuk nyimpen email dari Footer (Halaman Depan)
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ], [
            'email.unique' => 'Email ini sudah berlangganan newsletter kami.'
        ]);

        Subscriber::create([
            'email' => $request->email
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }

    // Fungsi untuk Admin ngehapus email
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Email subscriber berhasil dihapus.');
    }
}