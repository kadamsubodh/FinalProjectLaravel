<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\User_order;
use App\Coupon_used;
use App\Order_detail;
use App\UserAddress;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
  public function checkoutList(Request $request)
    {
        if(!Auth::user())
        {
            if(isset($_COOKIE['cartItems']))
            {
                $cookiedata=stripcslashes($_COOKIE['cartItems']);
                $product_ids= json_decode($cookiedata,true);                     
                if(count($product_ids)==0)
                {
                    Session::flash('alert-danger', "You don't have any product in your cart!!");
                    return redirect()->back();
                }
                else
                {
                    return view('frontend.checkout')->with('product_ids',$product_ids);
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
        	$user=Auth::user()->firstname.Auth::user()->id;
        	if(isset($_COOKIE[$user]))
        	{
        		$cookiedata=stripcslashes($_COOKIE[$user]);
        		$product_ids= json_decode($cookiedata,true);    	   		   		
        		if(count($product_ids)==0)
        		{
        			Session::flash('alert-danger', "You don't have any product in your cart!!");
        			return redirect()->back();
        		}
        		else
        		{
        			return view('frontend.checkout')->with('product_ids',$product_ids);
        		}
        	}
            else
            {
                Session::flash('alert-danger', "You don't have any product in your cart!!");
                return redirect()->back();
            }
        }  
        
    }
    public function setCookieForFinalCheckOutData(Request $request)
    {
        $cartSubTotal="";
        $ecoTax="";
        $total="";
        $shippingCharges="";
        $grandTotal="";
        $coupon_id=1;
        if(isset($_COOKIE['finalData']))
        {
            $checkOutData1=[];
            setcookie("finalData",null,time()-3600,'/');
            if(isset($_COOKIE['checkOutData']))
            {
                $cookiedata=stripcslashes($_COOKIE['checkOutData']);
                $checkOutData1= json_decode($cookiedata,true);
                $grandTotal=$checkOutData1['grandTotalAfterCouponApply'];
                $shippingCharges=$checkOutData1['shippingCharges'];
                $coupon_id=$checkOutData1['coupon_id'];
                $ecoTax=$checkOutData1['ecoTax'];
                $cartSubTotal=$request->cartSubTotal;
                $total=$request->total;                
            }
            else
            {
                $cartSubTotal=$request->cartSubTotal;
                $ecoTax=$request->ecoTax;
                $total=$request->total;
                $shippingCharges=$request->shippingCharges;
                $grandTotal=$request->grandTotal;
                $coupon_id=1;
            }
            $finalData=[];
            $finalData["cartSubTotal"]=$cartSubTotal;
            $finalData["ecoTax"]=$ecoTax;
            $finalData["total"]=$total;
            $finalData["shippingCharges"]=$shippingCharges;
            $finalData["grandTotal"]=$grandTotal;
            $finalData["coupon_id"]=$coupon_id;
            setcookie("finalData",json_encode($finalData),time()+3600,"/");
           
        }
        else
        {

            $cartSubTotal=$request->cartSubTotal;
            $ecoTax=$request->ecoTax;
            $total=$request->total;
            $shippingCharges=$request->shippingCharges;
            $grandTotal=$request->grandTotal;
            $coupon_id=1;          
            $finalData=[];
            $finalData["cartSubTotal"]=$cartSubTotal;
            $finalData["ecoTax"]=$ecoTax;
            $finalData["total"]=$total;
            $finalData["shippingCharges"]=$shippingCharges;
            $finalData["grandTotal"]=$grandTotal;
            $finalData["coupon_id"]=$coupon_id;
            setcookie("finalData",json_encode($finalData),time()+3600,"/");
           
        }
    }

    public function placeOrder(Request $request)
    {
        $billedTo_firstname="";
        $billedTo_lastname="";
        $billedTo_email="";
        $billedTo_address_1="";
        $billedTo_address_2="";
        $billedTo_city="";
        $billedTo_state="";
        $billedTo_country="";
        $billedTo_zipcode="";
        $shippedTo_firstname="";
        $shippedTo_lastname="";
        $shippedTo_email="";
        $shippedTo_address_1="";
        $shippedTo_address_2="";
        $shippedTo_city="";
        $shippedTo_state="";
        $shippedTo_country="";
        $shippedTo_zipcode="";
        $payement_mentod="";
        $product_ids=[];
        $checkOutData=[];
        $shippingCharges=0;
        $grandTotal=0;
        $coupon_id=1;
        $shipping_method="";
        $payment_gatewayId=$request->paymentMode;
        $user_id=0;

        if(Auth::user())
        {
            $user_id=Auth::user()->id;
            $user=Auth::user()->firstname.Auth::user()->id;
            $addressCount=UserAddress::where('user_id','=',Auth::user()->id)->get();          
            if(isset($_COOKIE[$user]))
            {
                $cookiedata=stripcslashes($_COOKIE[$user]);
                $product_ids= json_decode($cookiedata,true);
            }
            if(isset($_COOKIE['checkOutData']))
            {
                $cookiedata=stripcslashes($_COOKIE['checkOutData']);
                $checkOutData= json_decode($cookiedata,true);
                $grandTotal=$checkOutData['grandTotalAfterCouponApply'];
                $shippingCharges=$checkOutData['shippingCharges'];
                $coupon_id=$checkOutData['coupon_id'];
          
                if($shippingCharges=="Free")
                {
                    $shipping_method="Free";
                }
                else
                {
                    $shipping_method="charged";
                }
            }
            else
            {
                $cookiedata=stripcslashes($_COOKIE['finalData']);
                $checkOutData1= json_decode($cookiedata,true);
                $grandTotal=$checkOutData1['grandTotal'];
                $shippingCharges=$checkOutData1['shippingCharges'];
                $coupon_id=$checkOutData1['coupon_id'];
             
                if($shippingCharges==="Free")
                {
                    $shipping_method="Free";
                }
                else
                {
                    $shipping_method="charged";
                }
            }           

            if(count($addressCount)>0)
            {
                $validate=$request->validate([
                    "address"=>"required",                   
                ]);
                $userAddressId=$request->address;
                $userAddress=UserAddress::with('user')->where('id','=',$userAddressId)->where('user_id','=',Auth::user()->id)->get();
                foreach($userAddress as $user)
                {   
                    $billedTo_firstname=$user->user['firstname'];
                    $billedTo_lastname=$user->user['lastname'];                   
                    $billedTo_address_1=$user->address_1;
                    $billedTo_address_2=$user->address_2;
                    $billedTo_city=$user->city;
                    $billedTo_state=$user->state;
                    $billedTo_country=$user->country;
                    $billedTo_zipcode=$user->zipcode;
                }                              
            }
            else
            {
                $validate_UserAddress=$request->validate([
                    "billedTo_firstname"=>"required",
                    "billedTo_lastname"=>"required",                    
                    "billedTo_address_1"=>"required",
                    "billedTo_address_2"=>"required",
                    "billedTo_city"=>"required",
                    "billedTo_state"=>"required",
                    "billedTo_country"=>"required",
                    "billedTo_zipcode"=>"required",
                ]);

                $billedTo_firstname= $request->billedTo_firstname;
                $billedTo_lastname=$request->billedTo_lastname;                
                $billedTo_address_1=$request->billedTo_address_1;
                $billedTo_address_2=$request->billedTo_address_2;
                $billedTo_city=$request->billedTo_city;
                $billedTo_state=$request->billedTo_state;
                $billedTo_country=$request->billedTo_country;
                $billedTo_zipcode=$request->billedTo_zipcode;

                $addNewAddress=new UserAddress();
                $addNewAddress->user_id=Auth::user()->id;
                $addNewAddress->address_1=$billedTo_address_1;
                $addNewAddress->address_2=$billedTo_address_2;
                $addNewAddress->city=$billedTo_city;
                $addNewAddress->state=$billedTo_state;
                $addNewAddress->country=$billedTo_country;
                $addNewAddress->zipcode=$billedTo_zipcode;
                $addNewAddress->save();               
            }
        }
        else
        {
            if($request->checkOutOption=="newRegister")
            {
                $validate_UserAddress=$request->validate([
                "billedTo_firstname"=>"required",
                "billedTo_lastname"=>"required",
                "billedTo_email"=>"required|email",
                "billedTo_password"=>"required|max:12",
                "billedTo_confirm_password"=>"required|same:billedTo_password",
                "billedTo_address_1"=>"required",
                "billedTo_address_2"=>"required",
                "billedTo_city"=>"required",
                "billedTo_state"=>"required",
                "billedTo_country"=>"required",
                "billedTo_zipcode"=>"required",
                ]);
                if(isset($_COOKIE['checkOutData']))
                {
                    $cookiedata=stripcslashes($_COOKIE['checkOutData']);
                    $Data1= json_decode($cookiedata,true);
                    $grandTotal=$Data1['grandTotalAfterCouponApply'];
                        $shippingCharges=$Data1['shippingCharges'];
                        $coupon_id=$Data1['coupon_id'];
                    if($shippingCharges=="Free")
                    {
                        $shipping_method="Free";
                    }
                    else
                    {
                        $shipping_method="charged";
                    }
                }
                else
                {
                    $cookiedata=stripcslashes($_COOKIE['finalData']);
                    $checkOutData1= json_decode($cookiedata,true);
                    $grandTotal=$checkOutData1['grandTotal'];
                    $shippingCharges=$checkOutData1['shippingCharges'];
                    $coupon_id=$checkOutData1['coupon_id'];
                    if($shippingCharges==="Free")
                    {
                        $shipping_method="Free";
                    }
                    else
                    {
                        $shipping_method="charged";
                    }
                } 

                if(isset($_COOKIE["cartItems"]))
                {
                    $cookiedata=stripcslashes($_COOKIE["cartItems"]);
                    $product_ids= json_decode($cookiedata,true);
                }
                $billedTo_firstname= $request->billedTo_firstname;
                $billedTo_lastname=$request->billedTo_lastname;
                $billedTo_email=$request->billedTo_email;
                $billedTo_password=$request->billedTo_password;
                $billedTo_confirm_password=$request->billedTo_confirm_password;            
                $billedTo_address_1=$request->billedTo_address_1;
                $billedTo_address_2=$request->billedTo_address_2;
                $billedTo_city=$request->billedTo_city;
                $billedTo_state=$request->billedTo_state;
                $billedTo_country=$request->billedTo_country;
                $billedTo_zipcode=$request->billedTo_zipcode;

                $userObj=new User();
                $userObj->firstname=$request->billedTo_firstname;
                $userObj->lastname=$request->billedTo_lastname;
                $userObj->email=$request->billedTo_email;
                $userObj->password=bcrypt($request->billedTo_password);
                $userObj->status=1;
                $userObj->registration_method='n';
                $userObj->created_date=date("Y-m-d H:i:s");            
                $userObj->role_id=5;
                $userObj->save();
                if($userObj)
                {
                    $user_id=$userObj->id;
                }
                //save user address
                $addNewAddress=new UserAddress();
                $addNewAddress->user_id=$user_id;
                $addNewAddress->address_1=$billedTo_address_1;
                $addNewAddress->address_2=$billedTo_address_2;
                $addNewAddress->city=$billedTo_city;
                $addNewAddress->state=$billedTo_state;
                $addNewAddress->country=$billedTo_country;
                $addNewAddress->zipcode=$billedTo_zipcode;
                $addNewAddress->save();
            }
            else
            {
                $validate_UserAddress=$request->validate([
                "billedTo_firstname"=>"required",
                "billedTo_lastname"=>"required",
                "billedTo_email"=>"required|email",                
                "billedTo_address_1"=>"required",
                "billedTo_address_2"=>"required",
                "billedTo_city"=>"required",
                "billedTo_state"=>"required",
                "billedTo_country"=>"required",
                "billedTo_zipcode"=>"required",
                ]);

                if(isset($_COOKIE["cartItems"]))
                {
                    $cookiedata=stripcslashes($_COOKIE["cartItems"]);
                    $product_ids= json_decode($cookiedata,true);
                }
                $billedTo_firstname= $request->billedTo_firstname;
                $billedTo_lastname=$request->billedTo_lastname;                         
                $billedTo_address_1=$request->billedTo_address_1;
                $billedTo_address_2=$request->billedTo_address_2;
                $billedTo_city=$request->billedTo_city;
                $billedTo_state=$request->billedTo_state;
                $billedTo_country=$request->billedTo_country;
                $billedTo_zipcode=$request->billedTo_zipcode;

                $userObj=new User();
                $userObj->firstname=$request->billedTo_firstname;
                $userObj->lastname=$request->billedTo_lastname;               
                $userObj->password=bcrypt("password123");
                $userObj->status=1;
                $userObj->registration_method='n';
                $userObj->created_date=date("Y-m-d H:i:s");            
                $userObj->role_id=6;
                $userObj->save(); 
                if($userObj)
                {
                    $user_id=$userObj->id;
                } 
            }
        }
        if($request->isShippingAddressIsSame=="yes") //is shipping address is same as
                                                 //billing address
        {
            $shippedTo_firstname= $billedTo_firstname;
            $shippedTo_lastname=$billedTo_lastname;                   
            $shippedTo_address_1=$shippedTo_address_1;
            $shippedTo_address_2=$shippedTo_address_2;
            $shippedTo_city=$shippedTo_city;
            $shippedTo_state=$shippedTo_state;
            $shippedTo_country=$shippedTo_country;
            $shippedTo_zipcode=$shippedTo_zipcode;

        }
        else
        {
            $validate_shippingAddress=$request->validate([
                "shippedTo_firstname"=>"required",
                "shippedTo_lastname"=>"required",                        
                "shippedTo_address_1"=>"required",
                "shippedTo_address_2"=>"required",
                "shippedTo_city"=>"required",
                "shippedTo_state"=>"required",
                "shippedTo_country"=>"required",
                "shippedTo_zipcode"=>"required",
            ]);

            $shippedTo_firstname=$request->shippedTo_firstname;
            $shippedTo_lastname=$request->shippedTo_lastname;                    
            $shippedTo_address_1=$request->shippedTo_address_1;
            $shippedTo_address_2=$request->shippedTo_address_2;
            $shippedTo_city=$request->shippedTo_city;
            $shippedTo_state=$request->shippedTo_state;
            $shippedTo_country=$request->shippedTo_country;
            $shippedTo_zipcode=$request->shippedTo_zipcode;
        }

        $userOrder= new User_order();
        $userOrder->user_id=$user_id;
        $userOrder->shipping_method=$shipping_method;
        $userOrder->AWB_NO="abcd123";
        $userOrder->payment_gateway_id=$payment_gatewayId;
        if($payment_gatewayId==="1")
        {
            $userOrder->transaction_id="null";
        }
        else
        {
            $userOrder->transaction_id="";
        }
        $userOrder->status="p";
        $userOrder->grand_total=$grandTotal;
        $userOrder->shipping_charges=$shippingCharges;
        $userOrder->coupon_id=$coupon_id;
        $userOrder->billed_to_name=$billedTo_firstname. " " .$billedTo_lastname;
        $userOrder->billing_address_1=$billedTo_address_1;
        $userOrder->billing_address_2=$billedTo_address_2;
        $userOrder->billing_city=$billedTo_city;
        $userOrder->billing_state=$billedTo_state;
        $userOrder->billing_country=$billedTo_country;
        $userOrder->billing_zipcode=$billedTo_zipcode;

        $userOrder->shipped_to_name=$shippedTo_firstname. " " .$shippedTo_lastname;
        $userOrder->shipping_address_1=$shippedTo_address_1;
        $userOrder->shipping_address_2=$shippedTo_address_2;
        $userOrder->shipping_city=$shippedTo_city;
        $userOrder->shipping_state=$shippedTo_state;
        $userOrder->shipping_country=$shippedTo_country;
        $userOrder->shipping_zipcode=$shippedTo_zipcode;
        $userOrder->save();
        if($userOrder)
        {
            if($coupon_id!=1)
            {
                $coupon_used= new Coupon_used();
                $coupon_used->user_id=$user_id;
                $coupon_used->order_id=$userOrder->id;
                $coupon_used->coupon_id=$coupon_id;
                $coupon_used->save();
            }
            foreach($product_ids as $product_id => $quantity)
            {
                foreach(Product::where('id','=',$product_id)->get() as $product)
                {
                    $orderDetails= new Order_detail();
                    $orderDetails->order_id=$userOrder->id;
                    $orderDetails->product_id=$product->id;
                    $orderDetails->quantity=$quantity;
                    $orderDetails->ammount=$quantity*$product->special_price;
                    $orderDetails->save();
                }
            } 
            setcookie('cartItems',null,time()-3600);
            if(Auth::user())
            {
                setcookie(Auth::user()->firstname.Auth::user()->id,null,time()-3600);
            }
            else
            {
                setcookie("cartItems",null,time()-3600);
            }
            Session::flash('alert-success', "Order successfully placed!! Thank you.");
            return redirect("/eshopers/home");           
        }
    }

}
