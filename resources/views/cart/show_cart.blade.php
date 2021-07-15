@extends('layouts.master')
@section('title')
    <title>Giỏ hàng</title>
@endsection


@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
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
                        <td>@if(Session::get('coupon'))
                            <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}" >Xóa mã </a>
                            @endif</td>
                        <td >
                            <li style="margin-top: -15px">Tổng tiền món ăn: <span>{{number_format($total,0,',','.')}}đ</span></li>
                            <?php
                            
                                if(Session::get('coupon') != null)
                                {
                                    foreach (Session::get('coupon') as $key => $cou) {
                                       if ($cou['coupon_condition'] == 1) {
                                          $result = $cou['coupon_number']/100 * $total;
                                       } else {
                                        $result = $cou['coupon_number'];
                                       }
                                    }
                                } else {
                                    $result = 0;
                                }
                                
                            ?>
                            <li>Tiền giảm: {{number_format($result,0,',','.')}}đ</span></li>
                            <li>Tiền phải trả: <span>{{number_format($total-$result,0,',','.')}}đ</span></li>
                            
                        </td>
                        <td>
                            
                            
                            <?php 
                                $customer_id = Session::get('customer_id');
                                if ($customer_id!=null) {
                                    
                                
                            ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
                            <?php 
                                } else{

                                
                            ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                            <?php 
                                }
                        
                            ?>
                        </td>
                    </tr>
                   
                </tbody>
                
            </form>
            
            <tr>
                <td>
                    <form action="{{url('/check-coupon')}}" method="POST">
                        @csrf             
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="coupon" style="margin-left: 18px">
                        <input type="submit" value="Tính mã giảm giá" class="btn btn-default check_out"
                        
                        name="check_coupon">
                        
                    </form>
                    <?php
                        $message = Session::get('message');
                        echo $message;
                    ?>
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
            </table>
            
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection




