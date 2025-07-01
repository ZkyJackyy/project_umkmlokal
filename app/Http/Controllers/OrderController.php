<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at','desc')
            ->get();

        return view('orders.daftar', compact('orders'));
    }
    
    public function create(Product $product)
    {
        return view('orders.create', ['products' => $product]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required|exists:zacky_products,id',
            'jumlah'=>'required|integer|min:1',
            'alamat_pengiriman'=>'required|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);
        if($request->jumlah > $product->stok) {
            return back()->withErrors('Jumlah melebihi stok!');
        }

        DB::transaction(function() use($product,$request) {
            $subtotal = $product->harga * $request->jumlah;

            $order = Order::create([
                'user_id'=>Auth::id(),
                'tanggal_pemesanan'=>now(),
                'status'=>'pending',
                'total_harga'=>$subtotal,
                'alamat_pengiriman'=>$request->alamat_pengiriman
            ]);

            $order->orderItems()->create([
                'product_id'=>$product->id,
                'jumlah'=>$request->jumlah,
                'harga_satuan'=>$product->harga,
                'subtotal'=>$subtotal
            ]);

            $product->decrement('stok', $request->jumlah);
        });

        return redirect()->route('orders.daftar')
            ->with('success','Order berhasil dibuat!');
    }

    public function adminIndex()
    {
        $sellerId = Auth::id();

        $orders = Order::whereHas('orderItems.product.store', function ($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })
        ->with([
            'user',
            'orderItems.product.store' // penting agar relasi ke store bisa digunakan di view
        ])
        ->latest()
        ->paginate(10);

        return view('orders.list', compact('orders'));
    }
    public function accept(Order $order)
    {
        $order->update(['status' => 'diproses']);
        return redirect()->back()->with('success', 'Pesanan diterima.');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'dibatalkan']);
        return redirect()->back()->with('success', 'Pesanan ditolak.');
    }

}
