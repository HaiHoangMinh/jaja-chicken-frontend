<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamp = false;
    protected $guarded = [];
    protected $table = "customers";
}