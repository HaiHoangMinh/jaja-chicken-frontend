
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
						<h2 class="title text-center">Xin lỗi ! Đơn hàng của bạn chưa được thanh toán. </h2>
						<center><p>Vui lòng kiểm tra lại thẻ ATM hoặc chọn phương thức thanh toán khác</p></center>
                        <br/>
                        
                        <br/>
						<center>
							<form action="{{URL::to('/payment')}}">
                            	<input type="submit" value="Tiến hành thanh toán lại" class="btn btn-default" />
                        	</form>
						</center>
                        
					</div>
					
				</div>
			</div>
		</div>
	</section>
	

	

@endsection


