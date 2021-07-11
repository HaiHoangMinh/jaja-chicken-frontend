<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function categoryChildrent()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    // Lấy tất cả sản phẩm thuộc danh mục
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}