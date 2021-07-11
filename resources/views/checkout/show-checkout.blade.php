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

        
       

        <div class="register-req">
            <p>Vui lòng nhập thông tin người nhận hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Thông tin giao hàng</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout')}}" method="POST">
                                @csrf
                                <input type="email" placeholder="Email*" name="shipping_email">
                                <input type="text" placeholder="Họ và tên *"  name="shipping_name">
                                <input type="text" placeholder="Địa chỉ *"  name="shipping_address">
                                <input type="text" placeholder="SĐT *"  name="shipping_phone">
                                <p>Ghi chú</p>
                                <textarea name="shipping_note"  placeholder="VD: Ít cay,thêm tương ớt,..." rows="10"></textarea>
                                <input type="submit" value="Thanh toán" name="send_bill" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                        
                    </div>
                </div>
               					
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại đơn hàng</h2>
        </div>

        
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection

