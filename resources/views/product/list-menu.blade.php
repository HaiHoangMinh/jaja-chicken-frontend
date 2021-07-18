
@extends('layouts.master')
@section('title')
    <title>Danh sách món ăn</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')

<section id="advertisement">
    <div class="container">
        <img src="{{asset('images/menu0.png')}}" alt="" height="380"/>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            @include('components.sidebar')	
            <h2 class="title text-center">Danh sách thực đơn</h2>
                    <div class="col-md-4">
                        <label for="">Sắp xếp theo</label>
                        <form action="">
                            @csrf
                            <select name="sort" id="sort" class="form-control">
                                <option value="{{Request::url()}}?sort_by=none">--Lọc món ăn--</option>
                                <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                                <option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                                <option value="{{Request::url()}}?sort_by=kitu_az">--Từ A -> Z--</option>
                                <option value="{{Request::url()}}?sort_by=kitu_za">--Từ Z -> A--</option>
                            </select>
                        </form>
                    </div>
            <br/>			
            <div class="col-sm-9 padding-right">
                
                <div class="features_items"><!--features_items-->
                    
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
                       
                           
                        </div>
                    </div>

                    @endforeach
                    <ul class="pagination">
                        {{$products->links()}}
                    </ul>
                
            </div>
        </div>
    </div>
</section>



@endsection


