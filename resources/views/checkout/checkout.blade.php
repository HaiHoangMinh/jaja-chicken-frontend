@extends('layouts.master')
@section('title')
    <title>Đặt hàng</title>
@endsection

@section('content')
<section id="form"><!--form-->
    <div class="container" style="text-align: center; font-size: 40px; border: 1px dashed darkred; border-radius:15px;height: 250px;">
        <span>VUI LÒNG CHỌN HÌNH THỨC MUA HÀNG</span>
        <div class="form">
            <a href="{{URL::to('/login-checkout')}}" class="btn btn-primary " style="border-radius: 10px">Đăng nhập bằng tài khoản JAJA</a>
            <br/>   
            <span>Hoặc</span>
            <br/>   
            <a href="{{URL::to('/show-checkout')}}" class="btn btn-primary " style="border-radius: 10px">Mua hàng không cần tài khoản</a>
        </div>
    </div>
</section><!--/form-->
@endsection

