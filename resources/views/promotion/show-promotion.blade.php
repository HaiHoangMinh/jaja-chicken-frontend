
@extends('layouts.master')
@section('title')
    <title>Khuyến mãi</title>
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
		<div class="container" style="border: 1px solid silver; box-shadow: 2px 2px 2px 2px silver">
			<div class="row" style="width: 80%; margin-left: 10%">
                <div style="text-align: center; height: 100px;">
                    <h1>TIN KHUYẾN MÃI</h1>
                </div>
                @foreach($promotionRecommend as $promotion)
				<div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL::to('khuyen-mai/'.$promotion->id.'/'.$promotion->slug)}}">
                                        <img src="{{config('app.base_url').$promotion->feature_image_path}}" alt="" />
                                     </a>
                                    <div class="col-sm-12" style="height: 200px">
                                        <div >
                                            <a href="{{URL::to('khuyen-mai/'.$promotion->id.'/'.$promotion->slug)}}">
                                                <h4>{{$promotion->title}}</h4>
                                             </a>
                                        </div>
                                        <div style="margin-top: 15px;">
                                            <p>{{$promotion->desc}}</p>
                                            <a href="{{URL::to('khuyen-mai/'.$promotion->id.'/'.$promotion->slug)}}" class="btn btn-default " 
                                              name="add-to-cart">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                              
                        </div>
                   
                       
                    </div>
                </div>
                @endforeach
				</div>
                <center>
                    {{$promotionRecommend->links()}}
                </center>
			</div>
		</div>
	</section>
	

	

@endsection


