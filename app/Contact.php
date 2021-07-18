<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamp = false;
    protected $guarded = [];
    protected $table = "contacts";
}