<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();

class AccountController extends Controller
{
    // Hien thi thong tin khach hang
    public function index(){
        $customer_id = Session::get('customer_id');
        if($customer_id)
        {
             $customer = DB::table('customers')->where('id',$customer_id)->first();
            return view('account.show-account',compact('customer'));
        } else {
            return redirect('login-checkout');
        }
       
    }

     // Lich su mua hang
     public function history()
     {
         $data['customer_id'] = Session::get('customer_id');
         $bills = DB::table('bills')->where('customer_id', $data['customer_id'])->paginate(6);
         if($data['customer_id'])
        {
            $customer = DB::table('customers')->where('id', $data['customer_id'])->first();
            return view('account.history',compact('bills','customer'));
        } else {
            return redirect('login-checkout');
        }
        
     }
     public function update_account(Request $request)
     {
        $customer_id = Session::get('customer_id');
        if($customer_id)
        {
            DB::table('customers')
            ->where('id',$customer_id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
             return redirect()->back()->with('message','Cập nhật thành công!');
        } else {
            return redirect('login-checkout');
        }
     }
     public function update_password(Request $request)
     {
        $customer_id = Session::get('customer_id');
        
        if($customer_id)
        {
             if (md5($request->old_password)) {
                 # code...
             }
             return redirect()->back()->with('message','Đã thay đổi mật khẩu!');
        } else {
            return redirect('login-checkout');
        }
     }
     public function update_address(Request $request)
     {
        $customer_id = Session::get('customer_id');
        
        if($customer_id)
        {
            $city = DB::table('tinhthanhpho')->where('matp',$request->city)->first()->name;
            $province = DB::table('quanhuyen')->where('maqh',$request->province)->first()->name;
            $wards = DB::table('xaphuongthitran')->where('xaid',$request->wards)->first()->name;
            $address = $request->home . " - " . 
            $wards . " - " . 
            $province . " - " . 
            $city;
            DB::table('customers')
                    ->where('id',$customer_id)
                    ->update([
                    'address' => $address
                ]);
             return redirect()->back()->with('message','Đã thay đổi địa chỉ !');
        } else {
            return redirect('login-checkout');
        }
     }
     public function change_pass(Request $request)
     {
        $customer_id = Session::get('customer_id');
        $data = $request->all();
        if($customer_id)
        {
             $customer = DB::table('customers')->where('id',$customer_id)->first();
            return view('account.change-pass',compact('customer'));
        } else {
            return redirect('login-checkout');
        }
     }
     public function change_address()
     {
        $customer_id = Session::get('customer_id');
        if($customer_id)
        {
            $data1= DB::table('tinhthanhpho')->where('matp',1)->first();
            $data2 = DB::table('tinhthanhpho')->where('matp',24)->first();
            $city =array();
            $city[0] = $data1;
            $city[1] = $data2;
            return view('account.change-address',compact('city'));
        } else {
            return redirect('login-checkout');
        }
     }
}