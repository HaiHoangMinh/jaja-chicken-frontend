
@extends('layouts.master')
@section('title')
    <title>{{$product->name}}</title>
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
            @include('components.sidebar')
            
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{config('app.base_url').$product->feature_image_path}}" alt="" />
                            <h3>JAJA</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            
                              <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach($productImages as $productImage)
                                        <img src="{{config('app.base_url').$productImage->image_path}}" alt="{{$productImage->id}}" height="75px" width="60px">
                                     @endforeach
                                    </div>
                                    
                                    
                                </div>
                              
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2>{{$product->name}}</h2>
                            <p>Product ID: {{$product->id}}</p>
                            <img src="images/product-details/rating.png" alt="" />
                            <form action="#" method="POST">
                                @csrf
                                <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}">
                                <input type="hidden" value="{{$product->feature_image_path}}" class="cart_product_image_{{$product->id}}">
                                <input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">
                                <span>
                                <span style="font-size: 25px">{{number_format($product->price)}} VNĐ</span>
                                <label>Số lượng:</label>
                                <input name="qty" type="text" value="1" min="1"/>
                                <br/>
                                <button type="button" class="btn btn-default add-to-cart" 
                                 data-id_product="{{$product->id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                </form>
                            </span>
                            </form>
                            
                            
                                
                                     
                                <p><b>Tình trạng:</b> Còn món</p>
								<p><b>Giao hàng:</b> Có</p>
								<p><b>Thương hiệu:</b>JaJa-Chicken</p>
                                 
                        <br/>
                         
                            <a href=""><img src="/eshopper/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
                

{{-- 
                Phần dưới --}}
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Chi tiết</a></li>
                            <li><a href="#tag" data-toggle="tab">Món ăn cùng loại</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Phản hồi (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <h3>Thông tin món ăn:</h3>
                            <p>{{$product->content}}</p>
                        </div>
                        
                        
                        <div class="tab-pane fade" id="tag" >
                            @foreach($productSameTags as $productSameTag)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{config('app.base_url').$productSameTag->feature_image_path}}" alt="" />
                                            <h2>{{$productSameTag->price}}</h2>
                                            <p>{{$productSameTag->name}}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Viết phản hồi</b></p>
                                
                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Tên của bạn"/>
                                        <input type="email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="" ></textarea>
                                    
                                    <button type="button" class="btn btn-default pull-right">
                                        Gửi đi
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div><!--/category-tab-->
                
                @include('home.components.product_recommend')
                
            </div>
        </div>
    </div>
</section>

@endsection



