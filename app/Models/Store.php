<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $table = 'zacky_stores';

    public function user():BelongsTo{

        return $this->belongsTo(User::class,'user_id','id');
    }

    protected $fillable = [
        'user_id',
        'nama_toko',
        'deskripsi',
        'alamat',
        'logo',
        'status',
    ];
    public function products():HasMany{

        return $this->hasMany(Product::class,'store_id','id');
    }
}
