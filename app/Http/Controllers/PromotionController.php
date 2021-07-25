<?php

namespace App\Http\Controllers;

use App\Category;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc =  "Thả ga ăn gà rán với nhiều combo ưu đãi & giao hàng miễn phí! , 
        Tận hưởng những khoảnh khắc trọn vẹn cùng Jaja.";
        $meta_keywords = "ga ran,Gà rán,Đồ ăn với gà";
        $meta_title = "Jaja Chicken Việt Nam";
        $url_con = $request->url();
        $sliders = Slider::latest()->get();
        $promotions = DB::table('promotions')->get();
        $promotionRecommend = DB::table('promotions')->paginate(3);
        return view('promotion.show-promotion',compact('sliders','promotions',
        'meta_keywords','meta_title','url_con','meta_desc','promotionRecommend'));
    }
    public function detail($id,$slug)
    {
        $promotion = DB::table('promotions')->where('id',$id)->first();
        $promotions = DB::table('promotions')->where('id','!=',$id)->take(3)->get();
        $time = Carbon::parse($promotion->created_at)->format('H:i:s');
        $date = Carbon::parse($promotion->created_at)->format('d-m-Y');
        return view('promotion.detail-promotion',compact('promotion','promotions','time','date'));
    }
}