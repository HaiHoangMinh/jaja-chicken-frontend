@extends('layouts.master')
@section('title')
    <title>Đăng nhập/Đăng ký</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
    <style>
        
        .login-form {
            border: 2px solid #888888;
            border-radius: 10px;
            box-shadow: 5px 10px #888888;
            width: 100%;
            
        }
        .signup-form {
            border: 2px solid #888888;
            border-radius: 10px;
            box-shadow: 5px 5px 5px 5px #888888;
            width: 100%;
        }
        h2{
            color: darkred !important;
            text-align: center;
        }
        form {
            margin: 10px 10px 10px 10px;
        }
       
    </style>
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<br/>
<section ><!--form-->
    <div style="text-align: center; height: 150px;" >
        <h1>HÃY LÀ MỘT THÀNH VIÊN JAJA NGAY HÔM NAY</h1>
        <h3>Tận hưởng là thành viên JAJA với các ưu đãi & khuyến mãi đặc biệt!</h3>
    </div>
    <div class="container" style="height: 700px">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form" ><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{URL::to('/login')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="email_account" placeholder="Email Address" />
                        <input type="password" name="password_account" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox" value=""> 
                            <p style="margin-top: 14px;">Lưu thông tin đăng nhập</p>
                        </span>
                        <span>
                            <p style="margin-top: 14px;"> <a href="{{URL::to('/quen-mat-khau')}}">Quên mật khẩu ?</a></p>
                        </span>
                        <center>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </center>
                    </form>
                    <ul>
                        <li style="margin-right: 40px">
                            <a href="{{url('/login-facebook')}}" class="btn btn-default" style="width: 100%">
                            <img src="{{asset('images/fb.png')}}" alt="" height="30" width="30"> Đăng nhập bằng facebook</a>
                        </li>
                        <br/>
                        <li style="margin-right: 40px">
                            <a href="{{url('/login-google')}}" class="btn btn-default " style="width: 100%">
                            <img src="{{asset('images/gg.png')}}" alt="" height="30" width="30"> Đăng nhập bằng google    .</a>
                        </li>
                    </ul>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h3 class="or">Hoặc</h3>
            </div>
            <div class="col-sm-5">
                <div class="signup-form" ><!--sign up form-->
                    <h2>Đăng kí nhanh</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" placeholder="Họ và tên" name="customer_name"/>
                        <input type="email" placeholder="Email Address" name="customer_email"/>
                        <input type="password" placeholder="Password" name="customer_password"/>
                        <input type="text" placeholder="SĐT" name="customer_phone"/>
                        <label for="">Địa chỉ</label>
                        <select class="form-control choose city" name="city" id="city" >
                            <option value="">Chọn tỉnh/thành phố</option>
                          @foreach($city as $item)
                          <option value="{{$item->matp}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                        <br/>
                        <select class="form-control choose province" name="province" id="province" >
                            <option value="">Chọn quận huyện</option>
                            
                          </select>
                          <br/>
                          <select class="form-control wards" name="wards" id="wards" >
                            <option value="">Chọn xã phường</option>
                          </select>
                          <br/>
                          <input type="text" class="form-control home" placeholder="Số nhà/Đường/Nghách"
                          name = "home"
                   >
            
                        <center>
                            <button type="submit" class="btn btn-default">Đăng kí</button>
                        </center>                
                        
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection

