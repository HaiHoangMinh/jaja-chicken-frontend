<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('home')}}" class="active">Trang chủ</a></li>

       
        <li class="dropdown"><a href="#">Thực đơn
            <i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                @foreach($categoryLimit as $category)
                <li><a href="{{route('category.product',['slug' => $category->slug,'id' => $category->id])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </li> 
        
        <li><a href="#">Khuyến mãi</a></li>
        <li><a href="#">Dịch vụ</a></li>
        <li><a href="#">Phản hồi</a></li>
    </ul>
</div>