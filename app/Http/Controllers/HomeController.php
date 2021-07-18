<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc =  "Thả ga ăn gà rán với nhiều combo ưu đãi & giao hàng miễn phí! , 
        Tận hưởng những khoảnh khắc trọn vẹn cùng Jaja.";
        $meta_keywords = "ga ran,Gà rán,Đồ ăn với gà";
        $meta_title = "Jaja Chicken Việt Nam";
        $url_con = $request->url();
        $sliders = Slider::latest()->get();
        $promotions = DB::table('promotions')->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->get();
        return view('home.home',compact('sliders','categories','products','productRecommend','categoryLimit',
        'meta_keywords','meta_title','url_con','meta_desc','promotions'));
    }
    public function search(Request $request)
    {
        $keywords = $request->keyword;
        $productSearch = DB::table('products')->where('name','like','%'.$keywords."%")->get();
        return view('product.search',compact('productSearch'));
    }
    public function send_mail()
    {
        $to_name = "JAJA Chicken";
        $to_email = "haibg1998b@gmail.com";//send to this email

        $data = array("name"=>"Mail từ JAJA","body"=> "Cảm ơn bạn đã đặt hàng"); //body of mail.blade.php
    
        Mail::send('mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return redirect('/');
    }
}