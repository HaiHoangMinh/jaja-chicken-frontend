
@extends('layouts.master')
@section('title')
    <title>Liên hệ</title>
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
			<div class="col-sm-12 ">
                <br/>
                <h2 class="title text-center">Thông tin về JAJA Chicken</h2>
                <div class="col-sm-12">
                    <h4>Thông tin liên hệ</h4>
                    <p>Địa chỉ: </p>
                    <p>Địa chỉ: </p>
                    <p>Địa chỉ: </p>
                    <p>Số điện thoại: </p>
                    <p>Fanpage: <a href="https://www.facebook.com/JaJaChickenVietnam" target="_blank">JaJa Chicken
                        JAJA CHICKEN - SIÊU GÀ RÁN ĐẾN TỪ NHẬT BẢN</a>
                    <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" 
                        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" 
                        nonce="1c1288KD"></script>
                        <div class="fb-page" data-href="https://www.facebook.com/JaJaChickenVietnam" 
                        data-tabs="timeline" data-width="500px" 
                        data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/JaJaChickenVietnam" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/JaJaChickenVietnam">JaJa Chicken</a></blockquote></div></p>
                    <p>Địa chỉ local Map:</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.0394710419155!2d106.16529917291496!3d21.2699051172978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31356d4ef491863f%3A0x8348ee679576cb8c!2zMTA5IMSQLiBWw7UgTmd1ecOqbiBHacOhcCwgVMOibiBN4bu5LCBZw6puIETFqW5nLCBC4bqvYyBHaWFuZywgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1626575125249!5m2!1sen!2s" 
                    width="80%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

            </div>
            
        </div>
           
    </div>		
</section>
	

	

@endsection


