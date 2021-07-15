@extends('layouts.master')
@section('title')
    <title>Đổi địa chỉ giao hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
    
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<div class="brands_products"><!--brands_products-->
    
    
    <section>
        <div class="container" style="width: 70%">
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
                        <li><a href="{{URL::to('/vi-coupon')}}">Mã khuyến mãi</a></li>
                        <br/>
                        <li><a href="{{URL::to('/thong-bao')}}">Thông báo</a></li>
                        <hr/>
                        <li><a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                    </ul>
                </div>		
                <div class="col-sm-9 " >
                    <div class="features_items"><!--features_items-->
                        <br/>
                        <h2 class="title text-center">Đổi địa chỉ giao hàng</h2>
                        <div class="col-sm-6" style="margin-left: 25%; " >
                                <form action="{{URL::to('/update-address')}}" method="POST">
                                    @csrf                                        
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
                          name = "home">
                                              
                            <input type="submit" value="Cập nhật địa chỉ" class="btn btn-primary ">
                        </form>
    
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</div><!--/brands_products-->
@endsection

