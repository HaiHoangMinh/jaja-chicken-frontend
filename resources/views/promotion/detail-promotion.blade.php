
@extends('layouts.master')
@section('title')
    <title>JajaChicken Việt Nam</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
    <section>
		<div class="container" style="width: 75%;border: 1px solid silver; box-shadow: 2px 2px 2px 2px silver">
			<div class="row">
				<div class="col-sm-12">
					<div class="blog-post-area">
						<h2 class="title text-center"></h2>
						<div class="single-blog-post">
							<h2 style="font-weight: 700; color:darkred">{{$promotion->title}}</h2>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-star"></i> Khuyến mãi</li>
									<li><i class="fa fa-clock-o"></i> {{$time}}</li>
									<li><i class="fa fa-calendar"></i>{{$date}}</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<div style="font-size: 20px; line-height: 35px">
								{!!$promotion->content!!}
								<img src="{{config('app.base_url').$promotion->feature_image_path}}" alt="" height="600px">
							</div>
							
							
						</div>
						<div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px">
							<script async defer crossorigin="anonymous" 
                                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="KsfqTDTY"></script>
                               
                                
                                <div id="fb-root"></div>
                                
                                <script>src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" 
                                nonce="Yezi5QLW"></script>
                                <div class="fb-like" data-href="https://www.facebook.com/JaJaChickenVietnam" data-width="" data-layout="standard" 
                                data-action="like" data-size="large" data-share="true"></div>
                                <br/>
						</div>
					</div><!--/blog-post-area-->

				

			
					
				</div>	
			</div>
		</div>
		<div class="container">
			<div class="row" style="width: 80%; margin-left: 10%">
                <div style="text-align: center; height: 100px;">
                    <h1>TIN KHUYẾN MÃI KHÁC</h1>
                </div>
                @foreach($promotions as $item)
				<div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL::to('khuyen-mai/'.$item->id.'/'.$item->slug)}}">
                                        <img src="{{config('app.base_url').$item->feature_image_path}}" alt="" />
                                     </a>
                                    <div class="col-sm-12" style="height: 200px">
                                        <div >
                                            <a href="{{URL::to('khuyen-mai/'.$item->id.'/'.$item->slug)}}">
                                                <h4>{{$item->title}}</h4>
                                             </a>
                                        </div>
                                        <div style="margin-top: 15px;">
                                            <p>{{$item->desc}}</p>
                                            <a href="{{URL::to('khuyen-mai/'.$item->id.'/'.$item->slug)}}" class="btn btn-default " 
                                              name="add-to-cart">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                              
                        </div>
                   
                       
                    </div>
                </div>
                @endforeach
				</div>
			</div>
			<div style="margin: 30px 0 30px 0;">
				<center>
					<a href="{{URL::to('khuyen-mai/')}}" class="btn btn-danger " 
					name="add-to-cart">  QUAY LẠI DANH SÁCH KHUYẾN MÃI</a>
				</center>
			</div>
		</div>
		
	</section>

	

@endsection







