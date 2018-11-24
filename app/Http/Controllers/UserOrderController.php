<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\User_order;
use DB;
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

    public function checkEmailView(Request $request)
    {
        //  $startDate=date('Y-m-d', strtotime("-1 days")).'12:50:16';
        // $endDate=date('Y-m-d').'23:25:00';
        $userName="";
        $todaysOrderDetails='';
        $todaysOrders=User_order::with('user')->where('created_at', '>=',date('Y-m-d').' 00:00:00')->get();
        $orderStatus="";
        $totalRevenue=0;
        $totalOrderCount=0;
        $orderSummary="";


        foreach($todaysOrders as $todaysOrder)
        {
            
                $userName=$todaysOrder->user['firstname']." ".$todaysOrder->user['lastname'];
            
            if($todaysOrder->status=='p')
            {
                $orderStatus="pending";
            }
            else if($todaysOrder->status=='o')
            {
                $orderStatus="processing";
            }
            else if($todaysOrder->status=="s")
            {
                $orderStatus="shipped";
            }
            else if($todaysOrder->status=="d")
            {
                $orderStatus="deliverd";
            }

            $todaysOrderDetails.="<tr><td>".$todaysOrder->id."</td><td>".$userName."</td><td>".$todaysOrder->billing_address_1.",<br>".$todaysOrder->billing_address_2.",<br>".$todaysOrder->billing_city.", ".$todaysOrder->billing_state."<br>".$todaysOrder->billing_country.", ".$todaysOrder->billing_zipcode."</td><td>".$todaysOrder->grand_total."</td><td>".$orderStatus."</td></tr>";

            $totalOrderCount++;
            $totalRevenue=$totalRevenue+$todaysOrder->grand_total;

        }
        $todaysOrderTableView="<table border='1' style='border-collapse:collapse;'><tr><th>Order ID</th><th>Customer Name</th><th>Customer Address</th><th>Ammount</th><th>Status</th></tr>".$todaysOrderDetails."</table>";
        $orderSummary="<table border='1' style='border-collapse:collapse;'><tr><th>Total Orders</th><th>Revenue</th></tr><tr><td>".$totalOrderCount."</td><td>$".$totalRevenue."</td></tr></table>";
        echo $todaysOrderTableView."<br><br>";
        echo $orderSummary;
        exit();

    }
}
