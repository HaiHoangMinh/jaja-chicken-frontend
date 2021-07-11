@extends('layouts.master')
@section('title')
    <title>Đăng nhập/Đăng ký</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{URL::to('/login')}}" method="POST">
                        @csrf
                        <input type="email" name="email_account" placeholder="Email Address" />
                        <input type="password" name="password_account" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox" value=""> 
                            <p style="margin-top: 14px;">Lưu thông tin đăng nhập</p>
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng kí nhanh</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" placeholder="Họ và tên" name="customer_name"/>
                        <input type="email" placeholder="Email Address" name="customer_email"/>
                        <input type="password" placeholder="Password" name="customer_password"/>
                        <input type="text" placeholder="SĐT" name="customer_phone"/>
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection

