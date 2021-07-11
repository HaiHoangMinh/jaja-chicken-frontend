<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;  
session_start();

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->get();
        return view('checkout.login-checkout',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['name'] = $request->customer_name;
        $data['email'] = $request->customer_email;
        $data['phone_number'] = $request->customer_phone;
        $data['password'] = md5($request->customer_password);
        $customer_id = DB::table('customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('name',$request->customer_name);
        return Redirect('/checkout');
    }
    public function login(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customers')->where('email',$email)->where('password',$password)->first();
        
        if ($result) {
            Session::put('customer_id',$result->id);
            return Redirect('/checkout');
        } else {
            return Redirect('/login-checkout');
        }
       
    }
    public function checkout()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->take(3)->get();
        return view('checkout.show-checkout',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }

    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('shippings')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        Session::put('name',$request->shipping_name);
        return Redirect('/payment');
    }
    public function payment()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->get();
        return view('checkout.payment',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect('/login-checkout');
    }
    public function save-bill()
    {
        
    }
}