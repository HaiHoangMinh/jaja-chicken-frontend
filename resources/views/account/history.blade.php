@extends('layouts.master')
@section('title')
    <title>Lịch sử mua hàng</title>
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
    td {
        font-size: 15px !important;
    }
</style>
@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<section id="cart_items">
    
    <div class="container">
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
                    <li><a style="color: red" href="{{URL::to('/lich-su-mua-hang')}}">Lịch sử đơn hàng</a></li>
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
            <div class="col-sm-9">
                <div class="breadcrumbs">
            
        </div><!--/breadcrums-->
        <div class="col-sm-12 " >
            <div class="features_items"><!--features_items-->
                <br/>
                <h2 class="title text-center">Đơn hàng đã đặt</h2>
               
                <div class="table-responsive cart_info">

                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
        
                                <td class="description">Ngày đặt</td>
                                <td class="description">Địa chỉ giao hàng</td>
                                <td class="price">Số tiền trả</td>
                                <td class="quantity">Trạng thái</td>
                                <td></td>
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
                                   @if ($bill->status == 0)
                                    <p>Đã hủy</p>
                                   @elseif($bill->status == 1)
                                   <p>Đang chuẩn bị</p>
                                   @elseif($bill->status == 2)
                                   <p>Đang giao</p>
                                   @else
                                   <p>Đã giao</p>
                                   @endif
                               </td>
                               <td>
                                 <a href="{{URL::to('/lich-su-chi-tiet/'.$bill->id)}}">Chi tiết</a>
                               </td>
                               @if ($bill->status == 1)
                                  <td>
                                    <button class="btn btn-danger btn-huy-don" data-id_bill="{{$bill->id}}" 
                                        name="btn-huy-don">Hủy </button>
                                  </td>
                               @endif
                               
                                
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{$bills->links()}}
                </div>
                </div>
            
        </div>

            </div>
        </div>
        
        

</section> <!--/#cart_items-->
@endsection

