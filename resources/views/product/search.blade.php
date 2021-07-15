
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
	<section>
		<div class="container">
			<div class="row">			
				<div class="col-sm-12 padding-right">
					<div class="features_items">
						<br/>
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach($productSearch as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
						   
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
											@csrf
											<input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
											<input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}">
											<input type="hidden" value="{{$product->feature_image_path}}" class="cart_product_image_{{$product->id}}">
											<input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}">
											<input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">
	
											<a href="{{route('product.detail',['id' => $product->id])}}">
												<img src="{{config('app.base_url').$product->feature_image_path}}" alt="" />
												<h2>{{number_format($product->price).' '.'VNĐ'}}</h2>
												<p>{{$product->name}}</p>
	
											 
											 </a>
											<button type="button" class="btn btn-default add-to-cart" 
											 data-id_product="{{$product->id}}" name="add-to-cart">Thêm giỏ hàng</button>
											</form>
	
										</div>
									  
								</div>
						   
							   
							</div>
						</div>
						@endforeach
	
					</div>
					
				</div>
			</div>
		</div>
	</section>
	

	

@endsection


