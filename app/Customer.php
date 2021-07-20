<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamp = false;
    protected $guarded = [];
    protected $table = "customers";
}