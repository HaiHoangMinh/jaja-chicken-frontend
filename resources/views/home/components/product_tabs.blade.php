<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categories as $keyCategory => $category)
            <li class="{{ $keyCategory == 0  ? 'active':''}}">
                <a href="#category_tab_{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content">
        @foreach($categories as $key=>$categoryItem)
            <div class="tab-pane fade {{ $key == 0  ? 'active in':''}}" id="category_tab_{{$categoryItem->id}}" >
            
            @foreach($categoryItem->products as $productItem)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{config('app.base_url').$productItem->feature_image_path}}" alt="" />
                            <h2>{{number_format($productItem->price)}}</h2>
                            <p>{{$productItem->name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Đặt hàng</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        @endforeach
        
        
        
        
        
        
        
        
        
    </div>
</div><!--/category-tab-->