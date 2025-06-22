<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function product(): BelongsTo
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}

public function firstImage(): BelongsTo
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}
}
