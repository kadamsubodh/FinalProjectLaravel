<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use App\Product;
class productDetailsController extends Controller
{
    public function getDetails(Request $request) 
    {
    	$product_id=Route::current()->parameter('product_id');
    	$productDetails=Product::with('product_image')->where('id','=',$product_id)->get();
    	return view('frontend.productDetails',compact('productDetails'));
    }
}
