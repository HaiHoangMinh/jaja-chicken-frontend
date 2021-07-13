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
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('home')}}">Home</a></li>
              <li class="active">Lịch sử mua hàng</li>
            </ol>
        </div><!--/breadcrums-->

       
        <div class="review-payment">
            <h2>Đơn hàng đã đặt</h2>
        </div>
        <div class="table-responsive cart_info">
            <form action="" method="POST">
                @csrf
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
                
            </form>
            </table>
        </div>
        

</section> <!--/#cart_items-->
@endsection

