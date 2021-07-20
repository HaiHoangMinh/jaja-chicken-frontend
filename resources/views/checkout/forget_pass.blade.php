@extends('layouts.master')
@section('title')
    <title>Quên mật khẩu</title>
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
        <h1 style="color: darkred">LẤY LẠI MẬT KHẨU</h1>
        
    </div>
    <div class="container" style="height: 400px">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message')!!}
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {!! session()->get('error')!!}
                </div>
                @endif
                <div class="login-form" ><!--login form-->
                    <h2>Nhập địa chỉ email mà bạn sử dụng để đăng ký. Chúng tôi sẽ gửi cho bạn một email có link để đặt lại mật khẩu cho tài khoản của bạn.</h2>
                    <form action="{{URL::to('/reset-pass')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="email_account" placeholder="Email *" />
                        
                        <center>
                            <button type="submit" class="btn btn-default">Lấy lại mật khẩu</button>
                        </center>
                    </form>
                    
                </div><!--/login form-->
            </div>
          
        </div>
    </div>
</section><!--/form-->
@endsection

