<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'zacky_orders';
    
    protected $fillable = [
        'user_id','tanggal_pemesanan','status','total_harga','alamat_pengiriman'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
    ];
}
