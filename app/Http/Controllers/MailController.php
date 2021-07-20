<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
session_start();

class MailController extends Controller
{
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
    public function quen_mat_khau(Request $request)
    {

        return view('checkout.forget_pass');
    }
    public function reset_pass(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Lấy lại mật khẩu". " ". $now;
        
        $customer = Customer::where('email',$request->email_account)->get();
        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('error','Email chưa được đăng kí!');
            } else {
                $token_random = Str::random();
                $customer =  Customer::where('email',$request->email_account)->first();
                $customer->token = $token_random;
                $customer->save();
                // send mail
                $to_email = $request->email_account;
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$request->email_account);
                
                Mail::send('checkout.forget_pass_notify',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('message','Gửi xác nhận thành công, vui lòng kiểm tra email để lấy lại mật khẩu!');
            }
        }
        
    }
    public function update_new_pass(Request $request)
    {
        return view('checkout.new_pass');
    }
    public function reset_new_pass(Request $request)
    {
        $token_random = Str::random();
        $customer = Customer::where('email',$request->email)->where('token',$request->token)->get();
        $count_customer = $customer->count();
        if ($count_customer > 0) {
          $reset= Customer::where('email',$request->email)->where('token',$request->token)->first();
          $reset->password = md5($request->password);
          $reset->token = $token_random;
          $reset->save();
          return redirect('login-checkout')->with('message','Mật khẩu đã được thay đổi');
        } else {
            return redirect('quen-mat-khau')->with('message','Quá hạn đổi mật khẩu');
        }
    }
}