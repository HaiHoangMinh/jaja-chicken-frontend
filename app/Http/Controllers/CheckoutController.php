<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\RegisterRequest;
use App\Product;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $data1= DB::table('tinhthanhpho')->where('matp',1)->first();
        $data2 = DB::table('tinhthanhpho')->where('matp',24)->first();
        $city =array();
        $city[0] = $data1;
        $city[1] = $data2;
        return view('checkout.login-checkout',compact('sliders','categories','products',
        'productRecommend','categoryLimit','city'));
    }
    public function select_address(Request $request)
    {
        $data = $request->all();
            if ($data['action']) {
                $output = '';
                if ($data['action'] == 'city') {
                    $select_province = DB::table('quanhuyen')->where('matp',$data['ma_id'])->get();
                    $output .='<option value="">'."Chọn quận huyện".'</option>';
                    foreach ($select_province as $key => $province) {
                        $output .='<option value="'.$province->maqh.'">'.$province->name.'</option>';
                    }
                    
                }else{
                    $select_wards = DB::table('xaphuongthitran')->where('maqh',$data['ma_id'])->get();
                    $output .='<option value="">'."Chọn xã phường".'</option>';
                    foreach ($select_wards as $key => $wards) {
                        $output .='<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
                    }
                }
                echo $output;
            }
    }
    
    public function add_customer(RegisterRequest $request)
    {
        $data = array();
        $city = DB::table('tinhthanhpho')->where('matp',$request->city)->first()->name;
        $province = DB::table('quanhuyen')->where('maqh',$request->province)->first()->name;
        $wards = DB::table('xaphuongthitran')->where('xaid',$request->wards)->first()->name;
        $data['name'] = $request->customer_name;
        $data['email'] = $request->email;
        $data['phone_number'] = $request->customer_phone;
        $data['address'] = $request->home . " - " . 
        $wards . " - " . 
        $province . " - " . 
        $city;
        $data['password'] = md5($request->customer_password);
        $data['feature_image_path'] = '/storage/customer/N4nu1xqUXyylBg2yJ8nf.png';
        
        $customer_id = DB::table('customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect('/');
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
        $data1= DB::table('tinhthanhpho')->where('matp',1)->first();
        $data2 = DB::table('tinhthanhpho')->where('matp',24)->first();
        $city =array();
        $city[0] = $data1;
        $city[1] = $data2;
        return view('checkout.show-checkout',compact('sliders','categories','products',
        'productRecommend','categoryLimit','Time','city'));
    }

    public function save_checkout(Request $request)
    {
        $data = array();
        $cart = Session::get('cart');
        $total = 23000;
        $city = DB::table('tinhthanhpho')->where('matp',$request->city)->first()->name;
        $province = DB::table('quanhuyen')->where('maqh',$request->province)->first()->name;
        $wards = DB::table('xaphuongthitran')->where('xaid',$request->wards)->first()->name;
        if($cart != null)
        {
            $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->home . " - " . 
        $wards . " - " . 
        $province . " - " . 
        $city;
        $data['shipping_email'] = $request->shipping_email;
        $shipping_id = DB::table('shippings')->insertGetId($data);

        $data_payment = array();
       
        $data_payment['payment_method'] = $request->payment_option;
        $payment_id = DB::table('payments')->insertGetId($data_payment);
        //insert bills
        $bills_data = array();
        $bills_data['shipping_id'] = $shipping_id;
        $bills_data['status'] = 1;
        $bills_data['date_order'] = Carbon::now('Asia/Ho_Chi_Minh');
        $bills_data['payment_id'] = $payment_id;
        $bills_data['note'] = $request->shipping_note;
        foreach ($cart as $key => $value) {
            $total += $value['product_price']*$value['product_qty'];
        }
       
        $bills_data['total'] = $total;
        $bills_id = DB::table('bills')->insertGetId($bills_data);
        
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
            return redirect()->back()->with('message','Bạn không có gì để thanh toán !');
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
        $total = 23000;
        $cart = Session::get('cart');
        $coupons = Session::get('coupon');
        $coupon_used = Session::get('customer_id').",";
        if ($cart !=null) {
            $data['payment_method'] = $request->payment_option;
            $payment_id = DB::table('payments')->insertGetId($data);
            
            //insert bills
            $bills_data = array();
            $bills_data['customer_id'] = Session::get('customer_id');
            $bills_data['date_order'] = Carbon::now('Asia/Ho_Chi_Minh');
            $bills_data['status'] = 1;
            $bills_data['payment_id'] = $payment_id;
            $bills_data['note'] = $request->shipping_note;
            foreach ($cart as $key => $value) {
                $total += $value['product_price']*$value['product_qty'];
            }
            if($coupons !=null)
            {
                foreach ($coupons as $key => $coupon) {  
                   if($coupon['coupon_condition'] == 1)
                {
                    $total -= ($coupon['coupon_number']/100 *$total);
                }
                else {
                    $total -= $coupon['coupon_number'];
                }
                }
                foreach ($coupons as $key => $coupon) {
                    DB::table('coupons')
                    ->where('coupon_code',$coupon['coupon_code'])
                    ->update([
                    'coupon_time' => $coupon['coupon_time']-1
                    ]);
                    DB::table('coupons')
                    ->where('coupon_code',$coupon['coupon_code'])
                    ->update([
                    'coupon_used' => $coupon_used
                ]);
                }
               
            } else {
                $total -= 0;
            }
            $bills_data['total'] = $total;
            $bills_id = DB::table('bills')->insertGetId($bills_data);
            
            
            // bill detail
            $data_detail = array();
            foreach ($cart as $key => $val) {
                $data_detail['product_id'] = $val['product_id'];
                $data_detail['quantity'] = $val['product_qty'];
                $data_detail['bill_id'] = $bills_id;
                $data_detail_id = DB::table('bill_details')->insert($data_detail);
            }
            Session::forget('coupon');
            if ($data['payment_method'] == 1 ) {
                return view('checkout.cash');
            } else {
                Session::put('payment_id',$payment_id);
                $vnp_TmnCode = "OW78ECMO"; //Mã website tại VNPAY 
                $vnp_HashSecret = "GSAUHQVPKWRFWBELVNVIZQPIWOGTQYXK"; //Chuỗi bí mật
                $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://www.jajachicken.com/return-vnpay";
                $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. 
                $vnp_OrderInfo = "Thanh toan don hang Jaja. So tien:".$total." VND";
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $total * 100;
                $vnp_Locale = 'vn';
                $vnp_IpAddr = request()->ip();
        
                $inputData = array(
                    "vnp_Version" => "2.0.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                );
        
                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . $key . "=" . $value;
                    } else {
                        $hashdata .= $key . "=" . $value;
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
        
                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                   // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                    $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                }
                return redirect($vnp_Url);
            }
        } else {
            return redirect()->back()->with('message','Bạn không có gì để thanh toán !');
        }
        
    }
   // Thanh toan VNpay
    public function return(Request $request)
{
    
    if($request->vnp_ResponseCode == "00") {
        $id = Session::get('payment_id');
        DB::table('payments')
        ->where('id', $id)
        ->update([
            'money' => $request->vnp_Amount/100,
            'note' => $request->vnp_OrderInfo,
            'code_vnpay' => $request->vnp_BankTranNo,
            'vnp_paydate' =>$request->vnp_PayDate,
            'code_bank' =>$request->vnp_BankCode
        ]);
        $money = $request->vnp_Amount/100;
        return view('checkout.vnpay.vnpay_return',compact('money'))->with('success' ,'Đã thanh toán phí dịch vụ');
    }
    session()->forget('url_prev');
    return view('checkout.vnpay.atm')->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
}
}