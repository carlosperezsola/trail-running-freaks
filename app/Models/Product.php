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

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');

    }

    public function trademark()
    {
        return $this->belongsTo(Trademark::class);
    }
}
