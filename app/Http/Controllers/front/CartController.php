<?php

namespace App\Http\Controllers\front;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use Auth;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
    	$user=Auth::user()->firstname.Auth::user()->id;
    	$product_id=Route::current()->parameter('product_id');
    	if(isset($_COOKIE[$user]))
    	{
    		$cookiedata=stripcslashes($_COOKIE[$user]);
    		$product_ids= json_decode($cookiedata);
    		$id=Route::current()->parameter('product_id');
    		if(in_array($id,$product_ids))
    		{
    			 Session::flash('alert-danger', 'This product already exists in your cart!!');
    			 return redirect()->back();
    		}
    		else
    		{
    			array_push($product_ids, $id);
    			setcookie($user,json_encode($product_ids),time()+60*60*24*365,'/'); 
    			return redirect()->back();
    		}
    	}
    	else
    	{	
    		$product_ids=[];
		    $id=Route::current()->parameter('product_id');
		    array_push($product_ids, $id);
		    setcookie($user, json_encode($product_ids),time()+60*60*24*365,'/');
		    Session::flash('alert-success', 'Product added in your cart!!');
		    return redirect()->back();
		    	    
		}
    }

    public function removeFromCart(Request $request)
    {
    	$id=Route::current()->parameter('product_id');
    	$user=Auth::user()->firstname.Auth::user()->id;
    	if(isset($_COOKIE[$user]))
    	{
    		$cookiedata=stripcslashes($_COOKIE[$user]);
    		$product_ids= json_decode($cookiedata);    	   		   		
    		if($key=array_search($id,$product_ids)!==false)
    		{
    			unset($product_ids[$key]);
    			setcookie($user,json_encode($product_ids),time()+60*60*24*365,'/');
    			Session::flash('alert-success', "Item removed from cart!!");
    			return redirect()->back();
    		}   		
    	}
    	else
    	{
    		Session::flash('alert-danger', "You don't have any product in your cart!!");
    		return redirect()->back();
    	}
    }

    public function emptyCart(Request $request)
    {	
    	$user=Auth::user()->firstname.Auth::user()->id;
    	setcookie($user,null,time()-3600,'/');
    	return redirect('/eshopers/home');
    }

    public function cartList(Request $request)
    {
    	$user=Auth::user()->firstname.Auth::user()->id;
    	if(isset($_COOKIE[$user]))
    	{
    		$cookiedata=stripcslashes($_COOKIE[$user]);
    		$product_ids= json_decode($cookiedata);    	   		   		
    		if(count($product_ids)==0)
    		{
    			Session::flash('alert-danger', "You don't have any product in your cart!!");
    			return redirect()->back();
    		}
    		else
    		{
    			return view('frontend.cart')->with('product_ids',$product_ids);
    		}
    	}
    	else
    	{
    		Session::flash('alert-danger', "You don't have any product in your cart!!");
    		return redirect()->back();
    	}
    }
}
