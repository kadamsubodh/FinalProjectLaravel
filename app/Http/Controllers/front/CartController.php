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
    		$product_ids= json_decode($cookiedata,true);
    		$id=Route::current()->parameter('product_id');
    		if(array_key_exists($id,$product_ids))
    		{
    			 Session::flash('alert-danger', 'This product already exists in your cart!!');
    			 return redirect()->back();
    		}
    		else
    		{
    			$product_ids[$id]=1;
    			setcookie($user,json_encode($product_ids,true),time()+60*60*24*365,'/');
    			Session::flash('alert-success', 'Product added in your cart!!'); 
    			return redirect()->back();
    		}
    	}
    	else
    	{	
    		$product_ids=[];
		    $id=Route::current()->parameter('product_id');
		    $product_ids[$id]=1;
		    setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
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
    		$product_ids= json_decode($cookiedata, true); 
    		if(count($product_ids)>0)
    		{  
    	  		if(array_key_exists($id,$product_ids)!==false)
	    		{ 
	    			unset($product_ids[$id]);
	    			$countCartItem=count($product_ids);
	    			setcookie($user,json_encode($product_ids,true),time()+60*60*24*365,'/');    			
	    			Session::flash('alert-success', "Item removed from cart!!");
	    			if($countCartItem > 0)
	    			{
	    			return redirect('/eshopers/cart');
	    			}
	    			else
	    			{
	    				return redirect('eshopers/home');
	    			}
	    		}
	    	}
	    	else
	    	{
	    		Session::flash('alert-danger', "You don't have any product in your cart!!");
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
