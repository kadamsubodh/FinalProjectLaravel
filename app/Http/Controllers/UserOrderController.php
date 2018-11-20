<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\User_order;

class UserOrderController extends Controller
{
    public function checkOrderStatus(Request $request)
    {
    	$validate=$request->validate([
    		"email"=>"required|email",
    		"orderId"=>"required",

    	]);
    	$email=$request->email;
    	$orderId=$request->orderId;
    	$userId=0;
    	$status='';
    	$isExistEmail=User::where("email","=",$email)->get();    	
    	if(count($isExistEmail)>0)
    	{

    		foreach (User::where("email","=",$email)->get() as $user)
    		{
    			$userId=$user->id;
    			$order=User_order::where('id','=',$orderId)->where('user_id','=',$userId)->get();    			
    			if(count($order)>0)
    			{

    				foreach(User_order::where("id",'=',$orderId)->where('user_id','=',$userId)->get() as $userOrder)
	    			{
	    				$status=$userOrder->status;	    				
	    			}
	    		}
	    		else
	    		{
	    			echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Invalid Order Id</div>";

	    		}
    		}
    		if($status=='p')
    		{
    			echo "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your order status is: <strong>Pending</strong></div>";   			
    		}
    		else if($status=="o")
    		{
    			echo "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your order status is: <strong>In Process</strong></div>";
    		}
    		else if($status=='s')
    		{
    			echo "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your order status is: <strong>Shipped to Shipping address</strong></div>";
    		}
    		else if($status == 'd')
    		{
    			echo "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your order status is <strong>Delivered!!</strong></div>";
    		}   		
    	}
    	else
    	{
    		echo "<div class='alert alert-danger alert-dismissible'>
    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    	Email Id is not registerd email Id</div>";
    	}
    }
}
