<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Route;
use Cookie;
use Auth;
use App\User_wish_list;
use DB;
use Illuminate\Support\Facades\Session;
class frontViewController extends Controller
{
    public function listProducts(Request $request)
    {
    	$category=Route::current()->parameter('category');
    	if($category=='all')
    	{
    		$products=Product::with('product_image')->inRandomOrder()->where('is_featured',1)->where('product_status',1)->paginate(9);
    	}
    	else
    	{
    		$products=Product::with('product_image','product_category')->inRandomOrder()->whereHas('product_category',function($query){ $query->where('category_id','=',Route::current()->parameter('category'));})->where('product_status',1)->where('is_featured',1)->paginate(9);
    	}
    	return view('frontend.shop',compact('products'));
    }    
}
