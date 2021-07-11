
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
    <div class="container">
        <div class="row">
            @include('components.sidebar')
            
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Danh sách món ăn</h2>
                    @foreach($products as $product)
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
                       
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br/>
                    {{$products->links()}}
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

@endsection






