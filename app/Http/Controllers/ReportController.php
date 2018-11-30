<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use DB;
use Auth;
use App\User;
use App\User_order;
use App\Coupon_used;

class ReportController extends Controller
{
    public function getReport(Request $request)
    {
    	$typeOfReport=Route::current()->parameter('typeOfReport');
    	if($typeOfReport=='salesReport')
    	{
    		$totalOrders=User_order::all()->count();
    		$totalRevenue=User_order::sum('grand_total');
    		$totalUserRegistration=User::where('role_id','=','5')->count();
    		$ordersByMonth=DB::table('user_orders')->select(DB::raw('sum(grand_total) as `grand_total`'),DB::raw('MONTH(created_at) month'))->groupby('month')->get()->toArray();
    		$arrayOfOrders=[];
    		foreach($ordersByMonth as $key=>$value)
    		{
    			$arrayOfOrders[$value->month - 1]=$value->grand_total;

    		}
    		for($i=0;$i<12;$i++)
    		{
    			if(!array_key_exists($i, $arrayOfOrders))
    			{
    				$arrayOfOrders[$i]=0;
       			}
       		}
       		ksort($arrayOfOrders);
       		return view('admin.Reports.salesReport',compact('totalOrders','totalRevenue','totalUserRegistration'))->with('order_graph',json_encode($arrayOfOrders,JSON_NUMERIC_CHECK));
    	}
    	elseif ($typeOfReport=="customerReport")
    	{
    		$totalUserRegistration=User::where('role_id','=','5')->count();
    		$customersByMonth=DB::table('users')->select(DB::raw('count(id) as `totalUserInMonth`'),DB::raw('MONTH(created_at) month'))->groupby('month')->get()->toArray();
    		$arrayOfCustomers=[];
    		foreach($customersByMonth as $key=>$value)
    		{
    			$arrayOfCustomers[$value->month - 1]=$value->totalUserInMonth;

    		}
    		for($i=0;$i<12;$i++)
    		{
    			if(!array_key_exists($i, $arrayOfCustomers))
    			{
    				$arrayOfCustomers[$i]=0;
       			}
       		}
       		ksort($arrayOfCustomers);
       		return view('admin.Reports.customerReport',compact('totalUserRegistration'))->with('customer_graph',json_encode($arrayOfCustomers,JSON_NUMERIC_CHECK));


    	}
    	else if($typeOfReport=="couponReport")
    	{
    		$perPage=10;
    		$totalCouponUsed=Coupon_used::with('user','coupon')->latest()->paginate($perPage);
    		return view('admin.Reports.couponReport',compact('totalCouponUsed'));
    	}
    }
}
