<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    public function productOptionItems()
    {
        return $this->hasMany(ProductOptionItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
