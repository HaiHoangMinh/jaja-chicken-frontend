<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;

session_start();

class AccountController extends Controller
{
    // Hien thi thong tin khach hang
    use StorageImageTrait;
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
         $bills = DB::table('bills')->where('customer_id', $data['customer_id'])
         ->orderBy('id','DESC')->paginate(6);
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
            $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image_path','customer');
            if (!empty($dataUploadFeatureImage)) {
                //$user['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                
                $feature_image_path = $dataUploadFeatureImage['file_path'];
               
            } else {
                $feature_image_path = "https://fv2-1.failiem.lv/thumb_show.php?i=8vuneb5jj&view";
            }
            DB::table('customers')
            ->where('id',$customer_id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'feature_image_path' => $feature_image_path
        ]);
             return redirect()->back()->with('message','Cập nhật thành công!');
        } else {
            return redirect('login-checkout');
        }
     }
     public function update_password(Request $request)
     {
        $customer_id = Session::get('customer_id');
        $customer = DB::table('customers')->where('id',$customer_id)->first();
        if($customer_id)
        {
             if (md5($request->old_password) == md5($customer->password)) {
                if ($request->new_password == $request->new_repassword ) {
                    DB::table('customers')->update([
                        'password' =>md5($request->new_password),
                    ]);
                    return redirect()->back()->with('success','Đã thay đổi mật khẩu!');
                } else {
                    return redirect()->back()->with('errors','Mật khẩu nhập lại không khớp!');
                }
             } else {
                return redirect()->back()->with('errors','Bạn nhập sai mật khẩu cũ!');
             }
             
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
            $customer = DB::table('customers')->where('id',$customer_id)->first();
            $data1= DB::table('tinhthanhpho')->where('matp',1)->first();
            $data2 = DB::table('tinhthanhpho')->where('matp',24)->first();
            $city =array();
            $city[0] = $data1;
            $city[1] = $data2;
            return view('account.change-address',compact('city','customer'));
        } else {
            return redirect('login-checkout');
        }
     }
     public function show_coupoun()
     {
        $customer_id = Session::get('customer_id');
        
        if($customer_id)
        {
            $customer = DB::table('customers')->where('id',$customer_id)->first();
            $coupons = DB::table('coupons')->where('coupon_status',1)->get();
            return view('account.customer-coupon',compact('coupons','customer'));
        } else {
            return redirect('login-checkout');
        }
        
     }
     public function history_detail($id)
     {
        $data['customer_id'] = Session::get('customer_id');
        $bill = DB::table('bills')->where('id', $id)->first();
        $bill_detail =  DB::table('bill_details')->where('bill_id', $id)->get();
        $products = DB::table('products')->get();
        if ($bill->status != 0) {
            $delivery_time = Carbon::parse($bill->date_order);
            $delivery_time->addMinutes(45); 
        } else{
            $delivery_time = "Đã bị hủy";
        }
        if($data['customer_id'])
       {
           $customer = DB::table('customers')->where('id', $data['customer_id'])->first();
           return view('account.history-bill',compact('bill','customer','bill_detail','products','delivery_time'));
       } else {
           return redirect('login-checkout');
       }
     }
     public function cancel_bill(Request $request){
            DB::table('bills')
            ->where('id', $request->id)
            ->update([
                'status' => 0,
            ]);
     }
}