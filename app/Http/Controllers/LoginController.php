<?php

namespace App\Http\Controllers;

use App\Login;
use App\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
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
            return Redirect('/login-checkout')->with('error','Sai email hoặc mật khẩu!!');
        }
       
    }
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_customer_id',$provider->getId())->first();
        if($account){
            $account_name = DB::table('customers')->where('id',$account->customer)->first();
            Session::put('customer_login',$account_name->name);
            Session::put('customer_id',$account_name->id);
            return redirect('/khach-hang')->with('message', 'Đăng nhập thành công');
        }else{

            $customer = new Social([
                'provider_customer_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = DB::table('customers')->where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = DB::table('customers')->insert([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'phone_number' => '',

                ]);
            }
            $customer->login()->associate($orang);
            $customer->save();

            $account_name = DB::table('customers')->where('id',$account->user)->first();

            Session::put('customer_login',$account_name->name);
             Session::put('customer_id',$account_name->id);
            return redirect('/khach-hang')->with('message', 'Đăng nhập thành công');
        } 
    }

    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
public function callback_google(){
        $users = Socialite::driver('google')->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('id',$authUser->customer)->first();
        Session::put('customer_name',$account_name->name);
        Session::put('customer_id',$account_name->id);
        return redirect('/khach-hang')->with('message', 'Đăng nhập thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_customer_id', $users->id)->first();
        
        if($authUser){

            return $authUser;
        };
        

        $orang = Login::where('email',$users->email)->first();

            if(!$orang){
                $orang = DB::table('customers')->insert([
                    'name' => $users->name,
                    'email' => $users->email,
                    'password' => '',
                    'address' => '',
                    'phone_number' => '',
                ]);
              
            }
            $id = DB::table('customers')->where('email',$users->email)->first()->id;
            $customer = new Social([
                'provider_customer_id' => $users->id,
                'provider' => 'google',
                'customer' => $id,
            ]);
        $customer->save();
        $customer->login()->associate($orang);
        $authUser = Social::where('provider_customer_id', $users->id)->first();
        if($authUser){
            return $authUser;
        };
        
    }

}