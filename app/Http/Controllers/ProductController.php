<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Rating;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($product_id)
    {
        $categoryLimit = Category::where('parent_id',0)->get();
        $product = Product::find($product_id);
        $productImages = ProductImage::where('product_id',$product_id)->get();
        $productTags = ProductTag::where('product_id',$product_id)->get();
        $productSameTags = Product::where('category_id',$product->category_id)->get();
        $categories = Category::where('parent_id',0)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        $rating = DB::table('rating')->where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        
        return view('product.detail',compact('categoryLimit','product','categories','productRecommend',
        'productSameTags','productImages','rating'));
    }
    public function list_menu()
    {
        $categoryLimit = Category::where('parent_id',0)->get();
        
        $categories = Category::where('parent_id',0)->get();
        $productRecommend = Product::latest('view_count','desc')->take(12)->get();
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            
            if($sort_by == 'giam_dan')
            {
                $products = DB::table('products')->orderBy('price','DESC')->paginate(9)->
                appends(request()->query());
            } elseif($sort_by == 'tang_dan')
            {
                $products = DB::table('products')->orderBy('price','ASC')->paginate(9)->
                appends(request()->query());
            } elseif($sort_by == 'kitu_az')
            {
                $products = DB::table('products')->orderBy('name','ASC')->paginate(9)->
                appends(request()->query());
            }elseif($sort_by == 'kitu_za')
            {
                $products = DB::table('products')->orderBy('name','DESC')->paginate(9)->
                appends(request()->query());
            }
        } else {
            $products = DB::table('products')->paginate(9);
        }
        
        return view('product.list-menu',compact('categoryLimit','products','categories','productRecommend'));
    }
    public function load_feedback(Request $request)
    {
        $product_id = $request->product_id;
        $feedback = DB::table('feedbacks')->where('product_id',$product_id)->get();
        
        $output = '';
        
        foreach ($feedback as $key => $value) {
            if ($value->status == 1) {
                $name = DB::table('customers')->where('id',$value->customer_id)->first()->name;
            $output .= '
            <div class="row style_feedback">
                    <img src="" alt="">
                  <div class="col-md-2">
                
            </div>
            <div class="col-md-10">
                <p style="color:green;">@ '.$name.'</p>
                <p style="color:darkred;"> '.$value->date.'</p>
                <p>' .$value->content.'</p>
                </div>
            </div>
            <br/>
                ';
            } else {
                $output .= "";
            }
            
        }
        echo $output;
    }
    public function send_feedback(Request $request)
    {
        $feedback = array();
        $feedback['product_id'] = $request->product_id;
        $feedback['content'] = $request->feedback_content;
        $feedback['date'] = Carbon::now('Asia/Ho_Chi_Minh');
        $feedback['customer_id'] = Session::get('customer_id');
        $feedback_id = DB::table('feedbacks')->insert($feedback);

    }
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = DB::table('rating')->insert([
            'product_id' => $data['product_id'],
            'rating' =>$data['index']
        ]);
        echo "done";
    }
}