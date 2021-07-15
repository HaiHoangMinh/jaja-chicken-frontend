@extends('layouts.master')
@section('title')
    <title>Lịch sử mua hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<section id="cart_items">
    
    <div class="container">
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
            <div class="col-sm-9">
                <div class="breadcrumbs">
            
        </div><!--/breadcrums-->

       
            <h2>Đơn hàng đã đặt</h2>
        <div class="table-responsive cart_info">

            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">

                        <td class="description">Ngày đặt</td>
                        <td class="description">Địa chỉ giao hàng</td>
                        <td class="price">Số tiền trả</td>
                        <td class="quantity">Trạng thái</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                    <tr>
                        
                       <td>
                           <p>{{$bill->date_order}}</p>
                       </td>
                       <td>
                        <p>{{$customer->address}}</p>
                       </td>
                       <td>
                        <p>{{number_format($bill->total)}}</p>
                       </td>
                       <td>
                        <p>{{$bill->status}}</p>
                       </td>
                       <td>
                         <a href="">Chi tiết</a>
                       </td>
                        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            {{$bills->links()}}
        </div>
            </div>
        </div>
        
        

</section> <!--/#cart_items-->
@endsection

