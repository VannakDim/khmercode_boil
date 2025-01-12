<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable = ['category_id', 'brand_id', 'name', 'frequency', 'type', 'capacity', 'power', 'description', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

}
