@extends('layouts.master')
@section('title')
    <title>Thanh toán</title>
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
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('home')}}">Home</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                			
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại đơn hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <form action="{{url('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart')==true)
                            @php
								$total = 0;
                                $shipping = 0;
						    @endphp

                    @foreach(Session::get('cart') as $key=>$cart)
                            @php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total+=$subtotal;
							@endphp

                    <tr>
                        <td class="cart_product">
                            <img src="{{config('app.base_url').$cart['product_image']}}" alt="" width="100">
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart['product_name']}}</a></h4>
                            <p>Product ID: {{$cart['product_id']}} </p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                
                                    <input class="cart_quantity_input" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="1" size="1">
                                   
                                
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($subtotal,0,',','.')}}đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/delete-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    
                    @endforeach
                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td>
                        <td><a class="btn btn-default check_out" href="{{url('/delete-all')}}">Xóa toàn bộ sản phẩm </a></td>
                        <td>
                            <li>Tổng tiền: <span>{{number_format($total,0,',','.')}}đ</span></li>
                            <li>Phí dịch vụ: <span>3.000đ</span></li>
                            <li>Phí vận chuyển: <span>20.000đ</span></li>
                            <li>Tiền phải trả: <span>$61</span></li>
                            <td>
                                <form action="{{url('/check_coupon')}}" method="POST">
                                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="coupon">
                                    <input type="submit" value="Tính mã giảm giá" class="btn btn-default check_out"
                                    name="check_coupon">
                                    
                                </form>
                                
                                <?php 
									$customer_id = Session::get('customer_id');
									if ($customer_id!=null) {
										
									
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
								<?php 
									} else{

									
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
								<?php 
									}
							
								?>
                            </td>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="5"><center>
                            @php
                            echo "Vui lòng thêm sản phẩm vào giỏ hàng" 
                        @endphp
                        </center></td>
                        
                    </tr>
                    @endif
                </tbody>
                
            </form>
            </table>
        </div>
        <h4>Chọn hình thức thanh toán</h4>
        <br/>
        <form action="{{URL::to('/save-bill')}}" method="POST">
            @csrf
            <div class="payment-options">
                <span>
                    <label><input type="checkbox" name="payment_option" value="Thẻ ATM">Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" value="Tiền mặt"> Thanh toán khi nhận hàng</label>
                </span>
                <input type="submit" value="Hoàn tất" name="send_bill" class="btn btn-primary btn-sm float-right">
                
                
            </div>
        </form>
       
    </div>
</section> <!--/#cart_items-->
@endsection

