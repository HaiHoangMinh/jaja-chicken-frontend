<div class="col-sm-3">
					<div class="left-sidebar">
						<br>
						<h2>Thực đơn chính</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
						@foreach($categories as $category)
						<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{$category->id}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$category->name}}
										</a>
									</h4>
								</div>
								<div id="sportswear_{{$category->id}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
										@foreach($category->categoryChildrent as $categoryChildrent)
											<li>
												<a href="{{route('category.product',['slug' => $categoryChildrent->slug,'id' => $categoryChildrent->id])}}">
													{{$categoryChildrent->name}} 
												</a>
											</li>
										@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
						
					
						<div class="brands_products"><!--brands_products-->
							<h2>Món ăn được yêu thích</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								@foreach($productRecommend as $product)
									<li><a href="{{route('product.detail',['id' => $product->id])}}"> <span class="pull-right">({{$product->view_count}})</span>{{$product->name}}</a></li>
									
								@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						
						
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{asset('images/login_n.png')}}" alt="ship" height="350px" width="100%"
							style="margin: -20px 0 5px 0" />
						</div><!--/shipping-->
					
					</div>
				</div>