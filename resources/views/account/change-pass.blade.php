@extends('layouts.master')
@section('title')
    <title>Đổi mật khẩu</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
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
      
    }
    </style>
@endsection

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
                        <li><a style="color: red" href="{{URL::to('/doi-mat-khau')}}">Đổi mật khẩu</a></li>
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
                        <h2 class="title text-center">Đổi mật khẩu</h2>
                        <div class="col-sm-6" style="margin-left: 25%; " >
                                <form action="{{URL::to('/update-pass')}}" method="POST">
                                    @csrf                                        
                                    <div class="form-group">
                                                <label >Mật khẩu cũ:</label>
                                                <input type="password" class="form-control" placeholder="Nhập mật khẩu cũ"
                                                       name = "old_password"
                                                       value=""
                                                >
                                        </div>
                                    <div class="form-group">
                                            <label >Mật khẩu mới:</label>
                                            <input type="password" class="form-control" placeholder="Nhập mật khẩu mới"
                                                   name = "new_password"
                                                   value=""
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label >Nhập lại mật khẩu mới:</label>
                                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới"
                                               name = "renew_password"
                                               value=""
                                        >
                                </div>
                                <?php
                                        
                                ?>
                                              
                                              <input type="submit" value="Đổi mật khẩu" class="btn btn-primary ">
                                            </form>
    
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</div><!--/brands_products-->
@endsection

