@extends('layouts.master')
@section('title')
    <title>Đặt hàng</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('content')
<section style="line-height: 70px; height: 450px; margin-top: 35px; background-color: wheat  }}) "><!--form-->
    <div class="container check-out" style="text-align: center; 
    font-size: 40px; border: 1px solid silver; border-radius:15px; box-shadow: 5px 5px 5px 5px silver;
    height: 400px; width: 75%">
        <span>VUI LÒNG CHỌN HÌNH THỨC MUA HÀNG</span>
        <div class="form">
            <a href="{{URL::to('/login-checkout')}}" class="btn btn-primary btn-checkout" style="border-radius: 10px; font-size: 30px">ĐĂNG NHẬP BẰNG TÀI KHOẢN JAJA</a>
            <br/>   
            <span>Hoặc</span>
            <br/>   
            <a href="{{URL::to('/show-checkout')}}" class="btn btn-primary btn-checkout " style="border-radius: 10px;font-size: 30px;">MUA HÀNG KHÔNG DÙNG TÀI KHOẢN</a>
        </div>
    </div>
</section><!--/form-->
@endsection

