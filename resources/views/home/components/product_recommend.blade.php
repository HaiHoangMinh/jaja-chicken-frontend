<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($productRecommend as $key=>$product)
            @if($key%3==0)
                <div class="item {{$key == 0 ? 'active':'' }}">
            @endif
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
                @if($key%3 == 2)
                </div>
            @endif
            </div>
            
            @endforeach
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->