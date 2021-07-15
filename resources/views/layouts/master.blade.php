<!-- Dùng chung cho các trang -->

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Seo Meta --}}
    <meta name="description" content="Thả ga ăn gà rán với nhiều combo ưu đãi & giao hàng miễn phí! , Tận hưởng những khoảnh khắc trọn vẹn cùng Jollibee.">
    <meta name="author" content="">
    <meta name="keywords" content="JAJA-Chicken, gà rán hàng đầu Nhật Bản"/>
    <meta name="robots" content="all"/>
    <link rel="canonical" href="http://localhost:8000/">
    <link rel="shortcut icon" href="{{asset('images/logo-removebg-preview.png')}}" type="image/x-icon">
    
    @yield('title')
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/sweetAlert.css')}}" rel="stylesheet">
	@yield('css')
        
    </head>
    <body>
    @include('components.header')
    @yield('content')   
    @include('components.footer')
          
    <script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
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
    <script>
        $(document).ready(function(){
          $('.add-customer').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var _token =$('input[name="_token"]').val();
            var home = $('.home').val();
            $.ajax({
              url: '{{url('/insert-delivery')}}',
              method: 'POST',
              data: {wards:wards,province:province,home:home,city:city,_token:_token},
              success:function(data){
                alert("thêm thành công");
              }
            });
            
          })
          $('.choose').change(function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token =$('input[name="_token"]').val();
            var result = "";
            if (action == 'city') {
              result = 'province';
            } else {
              result = 'wards';
            }
            $.ajax({
              url: '{{url('/select-address')}}',
              method: 'POST',
              data: {action:action,ma_id:ma_id,_token:_token},
              success:function(data){
                $('#'+result).html(data);
              }
            });
          })
        });
    </script>
    @yield('js')
    </body>
</html>