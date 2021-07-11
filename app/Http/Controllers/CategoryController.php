<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index($slug,$category_id)
    {
        $categoryLimit = Category::where('parent_id',0)->get();
        $products = Product::where('category_id',$category_id)->paginate(12);
        $categories = Category::where('parent_id',0)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        return view('product.category.list',compact('categoryLimit','products','categories','productRecommend'));
    }
}