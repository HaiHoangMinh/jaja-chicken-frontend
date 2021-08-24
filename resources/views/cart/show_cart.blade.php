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
            <form>
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td></td>
                        <td></td>
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
                            <img src="{{config('app.base_url').$cart['product_image']}}" alt="" width="150" height="150">
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart['product_name']}}</a></h4>
                            <p>Product ID: {{$cart['product_id']}} </p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
                        </td>
                        <td></td>
                        <td></td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <button type="button" class="btn btn-default reduction" 
                                data-id="{{$cart['product_id']}}"
                                data-session_id="{{$cart['session_id']}}"> - </button>
                                
                                <input class="cart_quantity_input value_{{$cart['product_id']}}" type="number"
                                 value="{{$cart['product_qty']}}" min="1" id="value" disabled>
                                 <button type="button" class="btn btn-default increase" 
                                 data-id="{{$cart['product_id']}}" 
                                 data-session_id="{{$cart['session_id']}}"> + </button>  
                                
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" id="sub_total_{{$cart['product_id']}}">{{number_format($subtotal,0,',','.')}}đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/delete-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    
                    @endforeach
                    <tr>
                        {{-- <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td> --}}
                        <td><a class="btn btn-default check_out" href="{{url('/delete-all')}}">Xóa toàn bộ sản phẩm </a></td>
                       
                    </tr>
                   
                </tbody>
                
            </form>
            <tr>
                <td>
                    <br>
                    <form action="{{url('/check-coupon')}}" method="POST">
                        @csrf             
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="coupon" style="margin-left: 18px">
                        <input type="submit" value="Tính mã giảm giá" class="btn btn-default check_out"
                        name="check_coupon">
                    </form>
                    <?php
                    
                        if(Session::get('coupon') != null)
                        {
                            foreach (Session::get('coupon') as $key => $cou) {
                               if ($cou['coupon_limit'] <= $total) {
                                   # code...
                                   if ($cou['coupon_condition'] == 1) {
                                    $result = $cou['coupon_number']/100 * $total;
                                   } else {
                                    $result = $cou['coupon_number'];
                               }
                               } else {
                                   $result = 0;
                                   Session::put('message',"Đơn hàng chưa đạt giá trị tối thiểu");
                                   Session::forget('coupon');
                               }
                               
                            }
                        } else {
                            $result = 0;
                        }
                        
                    ?>
                    <?php
                        $message = Session::get('message');
                        echo  '<span class="text" style="padding-left:20px;">'.$message.'.</span></br>';
                        $message = Session::put('message',null);
                    ?>
                    @if(Session::get('coupon'))
                    <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}" >Xóa mã </a>
                    @endif
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td >
                    <li style="margin-top: -15px">Tổng tiền món ăn: <span id="total">{{number_format($total,0,',','.')}}đ</span></li>
                    <li>Tiền giảm: {{number_format($result,0,',','.')}}đ</span></li>
                    <li>Tiền phải trả: <span id="total2">{{number_format($total-$result,0,',','.')}}đ</span></li>
                    
                </td>
                <br>
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
            @else
                <center><h3>
                    <strong>
                        @php
                        echo "Vui lòng thêm sản phẩm vào giỏ hàng !" 
                        @endphp
                    </strong>
                </h3    >
                   
                </center>
                
            @endif
            </table>
            
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection




