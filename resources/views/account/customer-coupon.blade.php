@extends('layouts.master')
@section('title')
    <title>Đổi địa chỉ giao hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
    
@endsection
<style>
    .infor{
        margin-top: 20px;
        border: 1px solid silver;
        border-radius: 10px;
        box-shadow:  2px 2px 2px 2px silver;
        height: 200px;
        align-items: center;
    }
    .item {
        padding-top: 20px;
    }
    .item span {
        font-size: 15px;
        line-height: 30px;
    }
    .btn-change-img {
        border-radius: 50% !important;
    }
    img{
        border-radius: 50% !important;
    }
    a:hover {
        border-bottom: 1px solid red;
    }
</style>
@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<div class="brands_products"><!--brands_products-->
    
    
    <section>
        <div class="container" style="width: 70%">
            <div class="row infor">
                <div class="item">
                    <div class="col-md-4">
                         <img class="btn-change-img"><img src="{{$customer->feature_image_path}}" alt="" height="150" width="150"
                            >
                    </div>
                    <div class="col-md-8">
                        <p style="color: red"><strong>Xin chào!</strong></p>
                        <h3><strong>{{$customer->name}}</strong></h3>
                        <span>Tham gia từ: {{$customer->created_at}}</span>
                        <br/><span>Loại tài khoản: Member</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 brands-name " style="margin-top: 28px" >
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{URL::to('/khach-hang')}}">Thông tin tài khoản</a></li>
                        <br/>
                        <li><a href="{{URL::to('/lich-su-mua-hang')}}">Lịch sử đơn hàng</a></li>
                        <br/>
                        <li><a href="{{URL::to('/doi-mat-khau')}}">Đổi mật khẩu</a></li>
                        <br/>
                        <li><a href="{{URL::to('/doi-dia-chi')}}">Địa chỉ giao hàng</a></li>
                        <br/>
                        <li><a style="color: red" href="{{URL::to('/vi-coupon')}}">Mã khuyến mãi</a></li>
                        <hr/>
                        
                        <li><a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                    </ul>
                </div>		
                <div class="col-sm-9 " >
                    <div class="features_items"><!--features_items-->
                        <br/>
                        <h2 class="title text-center">Mã khuyến mãi hiện có</h2>
                        @foreach ($coupons as $coupon)
                            <div class="col-md-12" style="border: 1px solid silver; line-height: 23px; 
                            margin-top: -20px; margin-bottom: 50px; border-radius: 15px; ">
                                <div class="col-md-2">
                                    <img src="{{asset('images/discount-ticket.png')}}" alt="" height="100px" width="90">
                                </div>
                                <div class="col-md-7">
                                    <span>Mã giảm giá: {{$coupon->coupon_name}}</span>
                                    <br/><span>Mã code: {{$coupon->coupon_code}}</span>
                                    @if($coupon->coupon_condition == 1)
                                    <br/><span>Giá trị giảm: {{$coupon->coupon_number}}%</span>
                                    @else 
                                    <br/><span>Giá trị giảm: {{number_format($coupon->coupon_number,0,',','.')}}đ</span>
                                    @endif
                                    <br/><em><span>Ngày bắt đầu: {{$coupon->date_start}}</span><span> - Ngày kết thúc: {{$coupon->date_end}}</span> </em>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</div><!--/brands_products-->
@endsection

