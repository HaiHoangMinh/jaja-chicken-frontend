<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Product extends Model 
{
    use SoftDeletes;
    protected $table = 'products';
    public function productImage()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function productTag()
    {
        return $this->hasMany(ProductTag::class,'product_id');
    }
   
}