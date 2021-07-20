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
                    <span>Lần truy cập trước: </span>
                    <br/><span>Loại tài khoản: </span>
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
                <h2 class="title text-center">CHI TIẾT ĐƠN HÀNG</h2>
                
                <div class="table-responsive cart_info">
                    <br/>
                    <h2 class="title text-center">THÔNG TIN GIAO HÀNG</h2>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
        
                                <td >Khách hàng</td>
                                <td >Địa chỉ giao hàng</td>
                                <td >Số điện thoại</td>
                                <td >Email</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <p>{{$customer->name}}</p>
                            </td>
                            <td>
                             <p>{{$customer->address}}</p>
                            </td>
                            <td>
                             <p>{{$customer->phone_number}}</p>
                            </td>
                            <td>
                                <p>{{$customer->email}}</p>
                            </td>
                            <td>
                                <p>{{$bill->note}}</p>
                            </td>
                        </tbody>
                        
                    </table>
                </div>
                </div>
            
        </div>
        
        <div class="col-sm-12 " >
            <div class="features_items"><!--features_items--> 
                <div class="table-responsive cart_info">
                    <br/>
                    <h2 class="title text-center">Liệt kê chi tiết đơn hàng</h2>
                    
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
        
                                <td class="description">Tên món ăn</td>
                                <td class="description">Giá món ăn</td>
                                <td class="price">Số lượng</td>
                                <td class="quantity">Tổng tiền món ăn</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($bill_detail as $item)
                           <td>
                            <p>{{$products->where('id',$item->product_id)->first()->name}}</p>
                        </td>
                        <td>
                         <p>{{number_format($products->where('id',$item->product_id)->first()->price)}}</p>
                        </td>
                        <td>
                            <p>{{$item->quantity}}</p>
                           </td>
                        <td>
                         <p>{{number_format($products->where('id',$item->product_id)->first()->price*$item->quantity)}}</p>
                        </td>
                           
                    </tbody>
                    @endforeach 
                    </table>
                    <hr/><span>Tổng hóa đơn: {{number_format($bill->total)}}</span>
                    <br/><span>Phí dịch vụ: 3,000đ</span>
                    <br/><span>Phí ship: 20,000đ</span>
                    <br/><span>Thời gian giao hàng: {{$delivery_time}} </span>
                </div>
                </div>
            
        </div>
            </div>
        </div>
        
        

</section> <!--/#cart_items-->
@endsection

