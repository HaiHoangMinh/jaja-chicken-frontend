<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['provider_customer_id',  'provider',  'customer'];
    protected $table = "social";
    public function login(){
        return $this->belongsTo('App\Login', 'customer');
    }

}