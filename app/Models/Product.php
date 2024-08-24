<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class, 'thirdParty_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImageGalleries()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');

    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
