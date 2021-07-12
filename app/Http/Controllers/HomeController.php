<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $productSearch = DB::table('products')->where('name','like','%'.$keywords."%")->get();
        return view('product.search',compact('productSearch'));
    }
}