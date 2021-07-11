<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_id)
    {
        $categoryLimit = Category::where('parent_id',0)->get();
        $product = Product::find($product_id);
        $productImages = ProductImage::where('product_id',$product_id)->get();
        $productTags = ProductTag::where('product_id',$product_id)->get();
        $productSameTags = Product::where('category_id',$product->category_id)->get();
        $categories = Category::where('parent_id',0)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        return view('product.detail',compact('categoryLimit','product','categories','productRecommend','productSameTags','productImages'));
    }
}