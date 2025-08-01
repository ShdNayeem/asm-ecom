<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'discount_name',
        'discount_value',
        'valid_from',
        'valid_to',
        'is_active'
    ];
}
