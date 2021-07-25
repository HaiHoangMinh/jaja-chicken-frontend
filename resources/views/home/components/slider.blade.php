@php
    $base_Url = config('app.base_url');
@endphp

<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
							<li data-target="#slider-carousel" data-slide-to="3"></li>
							{{--<li data-target="#slider-carousel" data-slide-to="4"></li>
							<li data-target="#slider-carousel" data-slide-to="5"></li>
							<li data-target="#slider-carousel" data-slide-to="6"></li>
							 <li data-target="#slider-carousel" data-slide-to="7"></li>
							<li data-target="#slider-carousel" data-slide-to="8"></li>
							<li data-target="#slider-carousel" data-slide-to="9"></li> --}}
							
						</ol>
						
						<div class="carousel-inner" >
                        @foreach($sliders as $key => $slider)
							<div class="item {{$key == 0 ? 'active':''}}">
								<div class="col-sm-6">
									<h1>JAJA Chicken</h1>
									<h2>{{$slider->name}}</h2>
									<p>{{$slider->description}}</p>
									<a href="{{URL::to('/khuyen-mai/'.
									$promotions->where('slider_id',$slider->id)->first()->id
									.'/'.$promotions->where('slider_id',$slider->id)->first()->slug)}}" 
									class = "btn btn-default">Xem chi tiết</a>
								</div>
								<div class="col-sm-5">
									<img src="{{$base_Url.$slider->image_path}}" class="banner img-responsive" alt=""/>
								
								</div>
							</div>
                        @endforeach

							

							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->