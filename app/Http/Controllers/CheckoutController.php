<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slider;
use Carbon\Carbon;
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
        $data['address'] = $request->customer_address;
        $data['password'] = md5($request->customer_password);
        
        $customer_id = DB::table('customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('name',$request->customer_name);
        return Redirect('/');
    }
    public function login(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customers')->where('email',$email)->where('password',$password)->first();
        
        if ($result) {
            Session::put('customer_id',$result->id);
            Session::put('customer_name',$result->name);
            return Redirect('/');
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
        return view('checkout.checkout',compact('sliders','categories','products','productRecommend','categoryLimit'));
    }
    public function show_checkout()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $categoryLimit = Category::where('parent_id',0)->take(3)->get();
        $Time = Carbon::now();
        return view('checkout.show-checkout',compact('sliders','categories','products','productRecommend','categoryLimit','Time'));
    }

    public function save_checkout(Request $request)
    {
        $data = array();
        $cart = Session::get('cart');
        $total = 0;
        $coupon = Session::get('coupon')[0];
        if($cart != null)
        {
            $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_email'] = $request->shipping_email;
        $shipping_id = DB::table('shippings')->insertGetId($data);

        $data_payment = array();
       
        $data_payment['payment_method'] = $request->payment_option;
        $data_payment['status'] = "Hoàn tất thanh toán";
        
        $payment_id = DB::table('payments')->insertGetId($data_payment);
        //insert bills
        $bills_data = array();
        $bills_data['shipping_id'] = $shipping_id;
        $bills_data['status'] = "Đã tiếp nhận đơn hàng";
        $bills_data['date_order'] = Carbon::now('Asia/Ho_Chi_Minh');
        $bills_data['payment_id'] = $payment_id;
        $bills_data['note'] = $request->shipping_note;
        foreach ($cart as $key => $value) {
            $total += $value['product_price']*$value['product_qty'];
        }
        if($coupon !=null)
            {
                $coupon['coupon_time'] -= 1;
                if($coupon['coupon_condition'] == 1)
            {
                $total -= ($coupon['coupon_number']/100 *$total);
            }
            else {
                $total -= $coupon['coupon_number'];
            }
            } else {
                $total -= 0;
            }
        $bills_data['total'] = $total;
        $bills_id = DB::table('bills')->insertGetId($bills_data);
        DB::table('coupons')
        ->where('coupon_code',$coupon['coupon_code'])
        ->update([
            'coupon_time' => $coupon['coupon_time']
        ]);
        // bill detail
        $data_detail = array();
        foreach ($cart as $key => $val) {
            $data_detail['product_id'] = $val['product_id'];
            $data_detail['quantity'] = $val['product_qty'];
            $data_detail['bill_id'] = $bills_id;
            $data_detail_id = DB::table('bill_details')->insert($data_detail);
        }
       if ($data_payment['payment_method'] == 1 ) {
        return view('checkout.cash');
       } else {
        return view('checkout.cash');
       }
        }
        else {
            return Redirect('/');
        }
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
    public function save_bill(Request $request)
    {
        $data = array();
        $total = 0;
        $cart = Session::get('cart');
        $coupon = Session::get('coupon')[0];
        
        if ($cart !=null) {
            $data['payment_method'] = $request->payment_option;
            $data['status'] = "Đang chờ thanh toán";
            $payment_id = DB::table('payments')->insertGetId($data);
            //insert bills
            $bills_data = array();
            $bills_data['customer_id'] = Session::get('customer_id');
            $bills_data['status'] = "Đã tiếp nhận đơn hàng";
            $bills_data['date_order'] = Carbon::now();
            $bills_data['payment_id'] = $payment_id;
            $bills_data['note'] = $request->shipping_note;
            foreach ($cart as $key => $value) {
                $total += $value['product_price']*$value['product_qty'];
            }
            if($coupon !=null)
            {
                $coupon['coupon_time'] -= 1;
                if($coupon['coupon_condition'] == 1)
            {
                $total -= ($coupon['coupon_number']/100 *$total);
            }
            else {
                $total -= $coupon['coupon_number'];
            }
            } else {
                $total -= 0;
            }
            $bills_data['total'] = $total;
            $bills_id = DB::table('bills')->insertGetId($bills_data);
            DB::table('coupons')
            ->where('coupon_code',$coupon['coupon_code'])
            ->update([
                'coupon_time' => $coupon['coupon_time']
            ]);
            // bill detail
            $data_detail = array();
            foreach ($cart as $key => $val) {
                $data_detail['product_id'] = $val['product_id'];
                $data_detail['quantity'] = $val['product_qty'];
                $data_detail['bill_id'] = $bills_id;
                $data_detail_id = DB::table('bill_details')->insert($data_detail);
            }
            if ($data['payment_method'] == 1 ) {
                return view('checkout.cash');
            } else {
                return view('checkout.atm');
            }
        } else {
            return Redirect('/');
        }
        
    }
    // Lich su mua hang
    public function history()
    {
        $data['customer_id'] = Session::get('customer_id');
        $bills = DB::table('bills')->where('customer_id', $data['customer_id'])->get();
        $customer = DB::table('customers')->where('id', $data['customer_id'])->first();
        return view('checkout.history',compact('bills','customer'));
    }
    
}