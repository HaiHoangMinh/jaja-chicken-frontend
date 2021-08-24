@extends('layouts.master')
@section('title')
    <title>Thông tin tài khoản</title>
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
                        <li><a href="{{URL::to('/khach-hang')}}" style="color: red">Thông tin tài khoản</a></li>
                        <br/>
                        <li><a href="{{URL::to('/lich-su-mua-hang')}}">Lịch sử đơn hàng</a></li>
                        <br/>
                        <li><a href="{{URL::to('/doi-mat-khau')}}">Đổi mật khẩu</a></li>
                        <br/>
                        <li><a href="{{URL::to('/doi-dia-chi')}}">Địa chỉ giao hàng</a></li>
                        <br/>
                        <li><a href="{{URL::to('/vi-coupon')}}">Mã khuyến mãi</a></li>
                    
                        <hr/>
                        <li><a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                    </ul>
                </div>		
                <div class="col-sm-9 " >
                    <div class="features_items"><!--features_items-->
                        <br/>
                        <h2 class="title text-center" >Thông tin tài khoản</h2>
                        <div class="col-sm-6" style="margin-left: 25%; " >
                                <form action="{{URL::to('/update-account')}}" method="POST" enctype="multipart/form-data">
                                    @csrf                                        
                                    <div class="form-group">
                                                <label >Họ và tên:</label>
                                                <input type="text" class="form-control" placeholder="Họ và tên"
                                                       name = "name"
                                                       value="{{ $customer->name}}"
                                                >
                                        </div>
                                              <div class="form-group">
                                                <label >Email:</label>
                                                <input type="text" class="form-control" placeholder="Email"
                                                       name = "email"
                                                       value="{{ $customer->email}}"
                                                >
                                              </div>
                                              <div class="form-group">
                                                <label >Số điện thoại:</label>
                                                <input type="text" class="form-control" placeholder="SĐT"
                                                       name = "phone_number"
                                                       value="{{ $customer->phone_number}}"
                                                >
                                              </div>
                                                <div class="form-group">
                                                  <label >Ảnh đại diện</label>
                                                  <input type="file" class="form-control-file" 
                                                         name = "feature_image_path"
                                                  >
                                              </div>
                                              <div class="form-group">
                                                <img src="{{$customer->feature_image_path}}" alt="" height="100" width="100">
                                            </div> 
                                              <div class="form-group">
                                                <label >Địa chỉ hiện tại:</label>
                                                <br/>
                                                <span>{{$customer->address}}</span>
                                                <br/>
                                                <a href="">Đổi địa chỉ giao hàng</a>
                                              </div>
                                              <input type="checkbox" name="" id="" >
                                              <label>Gửi email cho tôi những ưu đãi của JAJA</label>
                                              <input type="submit" value="Cập nhật thông tin" class="btn btn-primary ">
                                            </form>
    
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</div><!--/brands_products-->
@endsection

