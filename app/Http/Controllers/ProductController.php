<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(6);
        return view('pages.list_product', compact('products'));
    }

    public function create()
    {
        $store = Store::where('user_id', Auth::id())->first();

        if (!$store) {
            return redirect()->back()->with('error', 'Anda belum memiliki toko.');
        }

        return view('product.form_add', compact('store'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            // 'store_id' => 'required|exists:stores,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:1000',
            'harga'       => 'required|string',
            'stok'        => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori'    => 'required|in:1,2,3,4,5', // karena kamu hardcode kategori
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $path;
        }

        $store = Store::where('user_id', Auth::id())->firstOrFail();
        // Simpan ke database
        Product::create([
            'store_id'    => $store->id,
            'nama_produk' => $validated['nama_produk'],
            'deskripsi'   => $validated['deskripsi'],
            'harga'       => $validated['harga'],
            'stok'        => $validated['stok'],
            'gambar'      => $validated['gambar'] ?? null,
            'kategori'    => $validated['kategori'],
        ]);

        return redirect()->route('store.home', $store->id)->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('product.form_edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        
        $validated = $request ->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:1000',
            'harga'       => 'required|string',
            'stok'        => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori'    => 'required|in:1,2,3,4,5', // karena kamu hardcode kategori
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $path;
        // }else{
        //     unset( $validated['gambar'] );
        }

        $updatedata = [
            'nama_produk' => $validated['nama_produk'],
            'deskripsi'   => $validated['deskripsi'],
            'harga'       => $validated['harga'],
            'stok'        => $validated['stok'],
            'kategori'    => $validated['kategori'],
        ];

        if (isset($validated['gambar'])) {
            $updatedata['gambar'] = $validated['gambar'];
        }

        $products->update($updatedata);

        return redirect()->route('store.home', $products->store_id)->with('success', 'Produk berhasil diupdate.');

    }

    public function destroy($id)
    {
        if(Gate::allows('delete')){

            $data = Product::findorfail($id);
            $data->delete();
            return redirect()->back()->with('success', 'data berhasil di hapus');
        }

    }
    public function show($id)
    {
        $product = Product::with('store')->findOrFail($id);
        return view('product.show', compact('product'));
    }
}
