
@extends('layouts.master')
@section('title')
    <title>ATM thanh toán</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
	<section>
		<div class="container">
			<div class="row">			
				<div class="col-sm-12 padding-right">
					<div class="features_items" style="align-items: center; font-size: 20px">
                        <br/>
						<h2 class="title text-center">Thanh toán thành công !!</h2>
                        <center><p>Bạn đã thanh toán thành công số tiền {{number_format($money,0,',','.')}}đ cho đơn hàng</p></center>
                        <center><p>Cảm ơn bạn đã tin tưởng và đặt hàng tại JAJA !!</p></center>
                        <br/>
                        
                        <br/>
						<center>
							<form action="{{URL::to('/')}}">
                            	<input type="submit" value="Quay lại trang chủ" class="btn btn-default" />
                        	</form>
						</center>
                        
					</div>
					
				</div>
			</div>
		</div>
	</section>
	

	

@endsection


