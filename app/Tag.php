<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    public function TagChild()
    {
        return $this->hasMany(ProductTag::class,'tag_id');
    }
}