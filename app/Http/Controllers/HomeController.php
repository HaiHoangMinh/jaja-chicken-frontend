<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->get();
        return view('home.home',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }
    public function search(Request $request)
    {
        $keywords = $request->keyword;
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->take(3)->get();
        return view('product.search',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }
}