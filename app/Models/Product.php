<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'short_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'warranty',
        'is_active',
        'is_featured',
    ];
}
