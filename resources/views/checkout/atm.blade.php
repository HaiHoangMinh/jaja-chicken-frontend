
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
					<div class="features_items" style="align-items: center">
                        <br/>
						<h2 class="title text-center">Cảm ơn bạn đã đặt hàng tại JAJA</h2>
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


