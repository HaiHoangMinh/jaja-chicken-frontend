<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="https://www.facebook.com/JaJaChickenVietnam" target="_blank"><i class="fa fa-phone"></i> +84 0383766181</a></li>
								<li><a href="https://www.facebook.com/JaJaChickenVietnam" target="_blank"><i class="fa fa-envelope"></i> hoangloi.sumida@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/JaJaChickenVietnam" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://www.instagram.com/jaja_friedchicken/" target="_blank"><i class="fa fa-instagram" target="_blank"></i></a></li>
								<li><a href="https://mail.google.com/mail/u/0/#sent" target="_blank"><i class="fa fa-google-plus" target="_blank"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{route('home')}}">
								<img src="/images/logo-removebg-preview.png" alt="" height=120px width=150px/>
							</a>
						</div>
		
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								
								<?php 
									$customer_id = Session::get('customer_id');
									$customer_name = Session::get('customer_name');
									if ($customer_id != null) {
										
									
								?>
								<li><span style="color: white; font-size: 14px">Xin chào: {{$customer_name}}</span></li>
								<br/>
								<li><a href="{{URL::to('/khach-hang')}}"><i class="fa fa-user"></i>Tài khoản</a></li>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-credit-card"></i> Thanh toán</a></li>
								<?php 
									} else{

									
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-credit-card"></i> Thanh toán</a></li>
								<?php 
									}
								?>
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i>
									 Giỏ hàng
									 <span id="show-cart"></span>
									</a></li>
								<?php 
									$customer_id = Session::get('customer_id');
									if ($customer_id!=null) {

								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
								<?php 
									} else{

									
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php 
									}
							
								?>
								
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						@include('components.main_menu')
					</div>
					<div class="col-sm-3">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							@csrf
							<div class="search_box pull-right">
								<input type="text" name="keyword" placeholder="Tìm kiếm" />

							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->