<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'short_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'warranty',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'original_price' => 'float',
        'selling_price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlsAttribute(): array
    {
        return $this->images
            ->map(function ($image) {
                if (str_starts_with($image->image_path, 'http://') || str_starts_with($image->image_path, 'https://')) {
                    return $image->image_path;
                }

                return Storage::url($image->image_path);
            })
            ->toArray();
    }
}
