<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'offer_price',
        'msme_no',
        'net_weight',
        'batch_no',
        'mfg_date',
        'mrp',
        'usp'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productImages(){
       return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

// If you want only one image (like the first one or a thumbnail):
    public function firstImage()
    {
        return $this->hasOne(ProductImage::class)->latestOfMany();
    }

}