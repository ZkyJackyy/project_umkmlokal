<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Laravel\Prompts\table;

class Product extends Model
{
    protected $table ='zacky_products';

    public function store():BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

}
