
@extends('layouts.master')
@section('title')
    <title>Tìm kiếm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')

	
	@include('home.components.slider')
	
	<section>
		<div class="container">
			<div class="row">
				@include('components.sidebar')				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						
						

						@endforeach
						
						
					</div><!--features_items-->

					
					@include('home.components.product_recommend')
					
				</div>
			</div>
		</div>
	</section>
	

	

@endsection


