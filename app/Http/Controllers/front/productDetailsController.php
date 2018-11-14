<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use App\Product;
use Auth;
class productDetailsController extends Controller
{
    public function getDetails(Request $request) 
    {
    	$quantity=0;
    	$product_id=Route::current()->parameter('product_id');
    	$productDetails=Product::with('product_image')->where('id','=',$product_id)->get();
    	if(!Auth::user())
    	{
    		if(isset($_COOKIE['cartItems']))
    		{

                $cookiedata=stripcslashes($_COOKIE['cartItems']);
                $product_ids= json_decode($cookiedata,true);                
                $quantity=$product_ids[$product_id];
    		}
    		else
    		{
    			$quantity=1;
    		}
    	}
    	else
    	{
    		if(isset($_COOKIE[Auth::user()->firstname.Auth::user()->id]))
    		{
    			$cookiedata=stripcslashes($_COOKIE[Auth::user()->firstname.Auth::user()->id]);
                $product_ids= json_decode($cookiedata,true);
                if(array_key_exists($product_id, $product_ids))
                {                
                	$quantity=$product_ids[$product_id];
            	}
            	else
            	{
            		$quantity=1;
            	}
    		}
    		else
    		{
    			$quantity=1;
    		}
    	}
    	return view('frontend.productDetails')->with(compact('productDetails'))->with(compact('quantity'));
    }
}
