<!-- Dùng chung cho các trang -->

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('images/logo-removebg-preview.png')}}" type="image/x-icon">
    @yield('title')
    <link href="{{asset('eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/sweetAlert.css')}}" rel="stylesheet">
	@yield('css')
        
    </head>
    <body>
    @include('components.header')
    @yield('content')   
    @include('components.footer')
          
    <script src="{{asset('eshopper/js/jquery.js')}}"></script>
	<script src="{{asset('eshopper/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('eshopper/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('eshopper/js/main.js')}}"></script>
    <script src="{{asset('js/sweetAlert.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.add-to-cart').click(function () {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,
                        cart_product_name:cart_product_name,
                        cart_product_image:cart_product_image,
                        cart_product_price:cart_product_price,
                        cart_product_qty:cart_product_qty,
                        _token:_token},
                    success:function (data) {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }
                });

            });
        });
    </script>
    @yield('js')
    </body>
</html>