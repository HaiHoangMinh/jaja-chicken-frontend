@extends('layouts.master')
@section('title')
<title>{{$product->name}}</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection
<style>
.cus_img {
    height: 130px;
    width: 150px;
}
</style>
@section('js')
<link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row">
            <br />
            @include('components.sidebar')

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
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
                                    <img src="{{config('app.base_url').$productImage->image_path}}"
                                        alt="{{$productImage->id}}" height="75px" width="60px">
                                    @endforeach
                                </div>


                            </div>

                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information">
                            <!--/product-information-->
                            <h2>{{$product->name}}</h2>
                            <p>Product ID: {{$product->id}}</p>
                            <form action="#" method="POST">
                                @csrf
                                <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                <input type="hidden" value="{{$product->name}}"
                                    class="cart_product_name_{{$product->id}}">
                                <input type="hidden" value="{{$product->feature_image_path}}"
                                    class="cart_product_image_{{$product->id}}">
                                <input type="hidden" value="{{$product->price}}"
                                    class="cart_product_price_{{$product->id}}">
                                <span>
                                    <span style="font-size: 25px">{{number_format($product->price)}} VN??</span>
                                    <label>S??? l?????ng:</label>
                                    <input name="qty" type="text" value="1" min="1"
                                        class="cart_product_qty_{{$product->id}}" />
                                    <br />
                                    <button type="button" class="btn btn-default add-to-cart"
                                        data-id_product="{{$product->id}}" name="add-to-cart">Th??m gi??? h??ng</button>
                            </form>
                            </span>
                            </form>
                            <div class="div">
                                <p><b>T??nh tr???ng:</b> C??n m??n</p>
                                <p><b>????nh gi??:</b> {{$rating}}/5 - {{$rating_count}} ????nh gi??</p>
                                <p><b>S??? l?????t xem: </b>{{$product->view_count}}</p>
                                <script async defer crossorigin="anonymous"
                                    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
                                    nonce="KsfqTDTY"></script>
                                <div class="fb-share-button" data-href="{{$url_con}}" data-layout="box_count"
                                    data-size="small"><a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{$url_con}}"
                                        class="fb-xfbml-parse-ignore">
                                        Chia s??? website</a></div>
                            </div>


                            <div id="fb-root"></div>

                            <script>
                            src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
                            nonce = "Yezi5QLW" >
                            </script>
                            <div class="fb-like" data-href="https://www.facebook.com/JaJaChickenVietnam" data-width=""
                                data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                            <br />


                        </div>
                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->


                {{-- 
                Ph???n d?????i --}}
                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Chi ti???t</a></li>
                            <li><a href="#tag" data-toggle="tab">M??n ??n c??ng lo???i</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Ph???n h???i ({{$feedback_count}})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details">
                            <h3>Th??ng tin m??n ??n:</h3>
                            {!!$product->content!!}
                        </div>


                        <div class="tab-pane fade" id="tag">
                            @foreach($productSameTags as $productSameTag)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                                <input type="hidden" value="{{$productSameTag->id}}"
                                                    class="cart_product_id_{{$productSameTag->id}}">
                                                <input type="hidden" value="{{$productSameTag->name}}"
                                                    class="cart_product_name_{{$productSameTag->id}}">
                                                <input type="hidden" value="{{$productSameTag->feature_image_path}}"
                                                    class="cart_product_image_{{$productSameTag->id}}">
                                                <input type="hidden" value="{{$productSameTag->price}}"
                                                    class="cart_product_price_{{$productSameTag->id}}">
                                                <input type="hidden" value="1"
                                                    class="cart_product_qty_{{$productSameTag->id}}">
                                                <img src="{{config('app.base_url').$productSameTag->feature_image_path}}"
                                                    alt="" />
                                                <h2>{{$productSameTag->price}}</h2>
                                                <p>{{$productSameTag->name}}</p>
                                                <button type="button" class="btn btn-default add-to-cart"
                                                    data-id_product="{{$productSameTag->id}}" name="add-to-cart">Th??m
                                                    gi??? h??ng</button>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">

                                <style>
                                .style_feedback {
                                    border: 1px solid #ddd;
                                    border-radius: 10px;
                                    background: #F0F0E9;
                                }
                                </style>
                                <p><strong>C??c ph???n h???i t??? kh??ch h??ng: </strong></p>
                                <form>
                                    {{csrf_field()}}
                                    <input type="hidden" name="feedback_product_id" value="{{$product->id}}"
                                        class="feedback_product_id">
                                    <div id="feedback_show"></div>

                                    <p></p>
                                </form>

                                @if(Session::get('customer_id'))
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>{{$customer->name}}</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>{{$now_time}}</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>{{$now_date}}</a></li>
                                </ul>
                                <p><strong>????nh gi?? s???n ph???m</strong></p>
                                <ul class="list-inline rating" title="Average Rating">
                                    @for($count=1;$count<=5;$count++) @php if($count <=$rating){ $color='color:#ffcc00;'
                                        ; } else { $color='color:#ccc;' ; } @endphp <li title="star_rating"
                                        id="{{$product->id}}-{{$count}}" data-index="{{$count}}"
                                        data-product_id="{{$product->id}}" data-rating="{{$rating}}" class="rating"
                                        style="cursor: pointer; color: #ccc;font-size: 30px">&#9733</li>
                                        @endfor
                                </ul>
                                <form>
                                    @csrf
                                    <label for=""><strong>Vi???t ph???n h???i: </strong></label>
                                    <textarea name="feedback" class="feedback_content"
                                        placeholder="VD:hello"></textarea>

                                    <button type="button" class="btn btn-default pull-right send-feedback">
                                        Th??m ph???n h???i
                                    </button>
                                    <div id="notify_feedback"></div>


                                </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                @include('home.components.product_recommend')

            </div>
        </div>
    </div>
</section>

@endsection