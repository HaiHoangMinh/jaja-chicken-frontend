<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;  
session_start();

class CartController extends Controller
{
    public function gio_hang(Request $request)
    {
        $meta_desc = 'Giỏ hàng của bạn';
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->get();
        return view('cart.show_cart',compact('meta_desc','products',
        'productRecommend','categoryLimit','meta_keywords','meta_title','url_canonical'));
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }

    public function delete_product($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('message','Xóa thất bại');
        }
    }

    public function update_cart(Request $request)
    {
        $data =  $request->all();
        $cart = Session::get('cart');
        if($cart == true)
        {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function delete_all_product()
    {
        $cart = Session::get('cart');
        if ($cart == true) {

            Session::forget('cart');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function check_coupon(Request $request)
    {
        $data = $request->all();
    }
    
}