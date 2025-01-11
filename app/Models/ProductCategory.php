<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name'];


    public function brands()
    {
        return $this->hasMany(ProductBrand::class);
    }


}
