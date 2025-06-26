<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function create()
    {
        return view('pages.form_add_store');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_toko' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'alamat'    => 'required|string',
        'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'    => 'required|in:aktif,nonaktif',
    ]);

    $data = $request->only(['nama_toko', 'deskripsi', 'alamat', 'status']);
    $data['user_id'] = Auth::user()->id;

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('logos', 'public');
    }

    Store::create($data);

    return redirect()->route('store.home')->with('success', 'Toko berhasil dibuat.');
}

    public function home()
    {
        $user = Auth::user();

        // Ambil store berdasarkan user yang login
        $store = Store::with('products')->where('user_id', $user->id)->first();

        if (!$store) {
            return redirect()->route('store.create')->with('error', 'Anda belum memiliki store.');
        }

        return view('pages.home_store', compact('store'));
    }
}
