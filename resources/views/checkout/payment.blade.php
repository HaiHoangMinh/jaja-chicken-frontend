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
            <h2>Xem lại giỏ hàng</h2>
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
                                $shipping = 20000;
                                $service = 3000;
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
                                
                                    <input class="cart_quantity_input" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="1" size="1" disabled>
                                   
                                
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($subtotal,0,',','.')}}đ</p>
                        </td>
                        
                    </tr>
                    
                    @endforeach
                    <tr>
                        <?php
                            
                                if(Session::get('coupon') != null)
                                {
                                    foreach (Session::get('coupon') as $key => $cou) {
                                       if ($cou['coupon_condition'] == 1) {
                                          $total -= $cou['coupon_number']/100 * $total;
                                       } else {
                                        $total -= $cou['coupon_number'];
                                       }
                                    }
                                } else {
                                    $total -= 0;
                                }
                                
                            ?>
                        <td>
                            <li>Tổng tiền: <span name="total">{{number_format($total,0,',','.')}}đ</span></li>
                            <li>Phí dịch vụ: <span>3.000đ</span></li>
                            <li>Phí vận chuyển: <span>20.000đ</span></li>
                            <li>Tiền phải trả: <span>{{number_format($total+$shipping+$service,0,',','.')}}đ</span></li>
                            <span>Bạn có thể nhập mã giảm giá cho đơn hàng trong giỏ hàng </span>
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
            
        <form action="{{URL::to('/save-bill')}}" method="POST">
            @csrf
            
            <div class="payment-options col-sm-6">
                <h4>Ghi chú cho đơn hàng</h4>
                <textarea name="shipping_note"  placeholder="VD: Ít cay,thêm tương ớt,..." rows="10"></textarea>
                <h4>Chọn hình thức thanh toán</h4>
                <select name="payment_option" id="" >
                    <option  value="1">Thanh toán khi nhận hàng</option>
                    <option  value="2" >Thanh toán qua thẻ ATM</option>
                    
                    <input type="submit" value="Hoàn tất" name="send_bill" class="btn btn-primary ">
                </select>
                
                
                
            </div>
        </form>
        <?php
                        $message = Session::get('message');
                        echo $message;
                    ?>
    </div>
</section> <!--/#cart_items-->
@endsection

