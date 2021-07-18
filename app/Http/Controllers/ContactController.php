<?php

namespace App\Http\Controllers;
use App\Slider;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
session_start();
class ContactController extends Controller
{
    public function index()
    {
        return view('home.contact');
    }
    
}