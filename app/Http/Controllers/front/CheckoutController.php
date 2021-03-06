<?php

namespace App\Http\Controllers\front;

use DB;
use URL;
use Mail;
use Auth;
use Config;
use App\User;
use App\Product;
use App\User_order;
use App\Coupon_used;
use App\UserAddress;
use App\Order_detail;
use App\Email_template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\Cost;
use Redirect;

class CheckoutController extends Controller
{
    private $_api_context;
    public function __construct()
    {

        /** setup PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

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
                    echo "You don't have any product in your cart!!";
                
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
        $percent_off=0;
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
                $percent_off=$checkOutData1['percent_off'];
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
                $percent_off=0;

            }

            $finalData=[];
            $finalData["cartSubTotal"]=$cartSubTotal;
            $finalData["ecoTax"]=$ecoTax;
            $finalData["total"]=$total;
            $finalData["shippingCharges"]=$shippingCharges;
            $finalData["grandTotal"]=$grandTotal;
            $finalData["coupon_id"]=$coupon_id;
            $finalData['percent_off']=$percent_off;
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
            $finalData['percent_off']=0;
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
        $ecoTax=0;
        $percent_off=0;
        $cartSubTotal=0;
        $orderSummaryForEmail="";
        $paymentMethod="";
        $emailId="";
        $subject="";
        $content="";
        $total=0;
        if($payment_gatewayId==="1")
        {
            $paymentMethod="Cash on delivery";
        }
        else
        {
            $paymentMethod="payPal";
        }

        if(Auth::user())
        {
            $user_id=Auth::user()->id;
            $emailId=Auth::user()->email;
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
                $percent_off=$checkOutData['percent_off'];
                $total=$checkOutData['subTotal']+$checkOutData['ecoTax'];
                $cartSubTotal=$checkOutData['subTotal'];
                $ecoTax=$checkOutData['ecoTax'];           
           
                if($shippingCharges=="Free")
                {
                    $shipping_method="Free";
                    $shippingCharges=0;
                }
                else
                {
                    $shipping_method="charged";
                }
                $orderSummaryForEmail="<tr><td> subtotal</td><td>$".$cartSubTotal."</td></tr><tr><td>ecoTax</td><td>$".$ecoTax."</td></tr><tr><td>Total</td><td>". $total."</td></tr><tr><td>Discount</td><td>".$percent_off."%</td></tr><tr><td>shipping Charges</td><td>$".$shippingCharges."</td><tr><td>Final ammount</td><td>$".$grandTotal."</td></tr>";
            }
            else if(isset($_COOKIE['finalData']))
            {
                $cookiedata=stripcslashes($_COOKIE['finalData']);
                $checkOutData1= json_decode($cookiedata,true);
                $grandTotal=$checkOutData1['grandTotal'];
                $shippingCharges=$checkOutData1['shippingCharges'];
                $coupon_id=$checkOutData1['coupon_id'];              
                $ecoTax=$checkOutData1['ecoTax'];
                $cartSubTotal=$checkOutData1['cartSubTotal'];
                $percent_off=$checkOutData1['percent_off'];
                $total=$cartSubTotal+$ecoTax;                             
                if($shippingCharges==="Free")
                {
                    $shipping_method="Free";
                    $shippingCharges=0;
                }
                else
                {
                    $shipping_method="charged";
                }
                $orderSummaryForEmail="<tr><td>subtotal</td><td>$".$cartSubTotal."</td></tr><tr><td>ecoTax</td><td>$".$ecoTax."</td></tr><tr><td>Total</td><td>$". $total."</td></tr><tr><td>shipping Charges</td><td> $".$shippingCharges."</td></tr><tr><td>Final ammount</td><td>$".$grandTotal."</td></tr>";  
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
                    "billedTo_zipcode"=>"required|regex:/\b\d{6}\b/",
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
                "billedTo_zipcode"=>"required|regex:/\b\d{6}\b/",
                ]);
                $emailId=$request->billedTo_email;
                if(isset($_COOKIE['checkOutData']))
                {
                    $cookiedata=stripcslashes($_COOKIE['checkOutData']);
                    $Data1= json_decode($cookiedata,true);
                    $grandTotal=$Data1['grandTotalAfterCouponApply'];
                    $shippingCharges=$Data1['shippingCharges'];
                    $coupon_id=$Data1['coupon_id'];
                    $percent_off=$Data1['percent_off'];
                    $total=$Data1['subTotal']+$Data1['ecoTax'];
                    $cartSubTotal=$Data1['subTotal'];
                    $ecoTax=$Data1['ecoTax'];                    
                    if($shippingCharges=="Free")
                    {
                        $shipping_method="Free";
                        $shippingCharges=0;
                    }
                    else
                    {
                        $shipping_method="charged";
                    }
                    $orderSummaryForEmail="<tr><td> subtotal</td><td>$".$cartSubTotal."</td></tr><tr><td>ecoTax</td><td>$".$ecoTax."</td></tr><tr><td>Total</td><td>". $total."</td></tr><tr><td>Discount</td><td>".$percent_off."%</td></tr><tr><td>shipping Charges</td><td>$".$shippingCharges."</td><tr><td>Final ammount</td><td>$".$grandTotal."</td></tr>";
                }
                else
                {
                    $cookiedata=stripcslashes($_COOKIE['finalData']);
                    $checkOutData1= json_decode($cookiedata,true);
                    $grandTotal=$checkOutData1['grandTotal'];
                    $shippingCharges=$checkOutData1['shippingCharges'];
                    $coupon_id=$checkOutData1['coupon_id'];
                    $ecoTax=$checkOutData1['ecoTax'];
                    $cartSubTotal=$checkOutData1['cartSubTotal'];
                    $total=$cartSubTotal+$ecoTax;
                    $percent_off=$checkOutData1['percent_off'];                    
                    if($shippingCharges==="Free")
                    {
                        $shipping_method="Free";
                        $shippingCharges=0;
                    }
                    else
                    {
                        $shipping_method="charged";
                    }
                    $orderSummaryForEmail="<tr><td> subtotal</td><td>$".$cartSubTotal."</td></tr><tr><td>ecoTax</td>$".$ecoTax."</td></tr><tr><td>Total</td><td>$".$total."</td></tr><tr><td>shipping Charges</td><td>$".$shippingCharges."</td><tr><td>Final ammount</td><td>$".$grandTotal."</td></tr>";
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
                    $permissions=DB::table('role_has_permissions')->where('role_id','=',$userObj->role_id)->get();
                    DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$userObj->role_id,'App\User',$user_id] );
                    foreach($permissions as $permission)
                    {
                        DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission->permission_id,'App\User', $user_id]);
                    }
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
                "billedTo_zipcode"=>"required|regex:/\b\d{6}\b/",
                ]);
                $emailId=$request->billedTo_email;

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
                $userObj->email=$request->billedTo_email;              
                $userObj->password=bcrypt("password123");
                $userObj->status=1;
                $userObj->registration_method='n';
                $userObj->created_date=date("Y-m-d H:i:s");            
                $userObj->role_id=6;
                $userObj->save(); 
                if($userObj)
                {
                    $user_id=$userObj->id;
                    $permissions=DB::table('role_has_permissions')->where('role_id','=',$userObj->role_id)->get();
                    DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$userObj->role_id,'App\User',$user_id] );
                    foreach($permissions as $permission)
                    {
                        DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission->permission_id,'App\User',$user_id]);
                    }
                } 
            }
        }
        //is shipping address is same as billing address
        if($request->isShippingAddressIsSame=="yes") 
        {
            $shippedTo_firstname= $billedTo_firstname;
            $shippedTo_lastname=$billedTo_lastname;                   
            $shippedTo_address_1=$billedTo_address_1;
            $shippedTo_address_2=$billedTo_address_2;
            $shippedTo_city=$billedTo_city;
            $shippedTo_state=$billedTo_state;
            $shippedTo_country=$billedTo_country;
            $shippedTo_zipcode=$billedTo_zipcode;

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
                "shippedTo_zipcode"=>"required|regex:/\b\d{6}\b/",
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
            $billingAddress="<b>".$billedTo_firstname. " " .$billedTo_lastname."<b><br>".$billedTo_address_1.",<br>".$billedTo_address_2.",<br>".
            $billedTo_city.", ".$billedTo_state.",<br>".$billedTo_country.", ".$billedTo_zipcode;

            $shippingAddress="<b>".$shippedTo_firstname. " " .$shippedTo_lastname."<b><br>".$shippedTo_address_1."<b>,<br>".$shippedTo_address_2.",<br>".
            $shippedTo_city.", ".$shippedTo_state.",<br>".$shippedTo_country.", ".$shippedTo_zipcode;

            $orderSummaryForEmailView="<table border='1' style='border-collapse: collapse; align:right'>".$orderSummaryForEmail."</table>";

            Session::put('billingAddress',$billingAddress);
            Session::put('shippingAddress',$shippingAddress);
            Session::put('orderSummaryForEmailView',$orderSummaryForEmailView);
            Session::put('payment_gateway_id', $payment_gatewayId);
            Session::put('userOrderId',$userOrder->id);
            Session::put('coupon_id',$coupon_id);
            Session::put('user_id',$user_id);
            Session::put('product_ids',$product_ids);
            Session::put('emailId',$emailId);  
            Session::put('paymentMethod', $paymentMethod);
            if($payment_gatewayId=='2')
            {
                $currency="USD";
                $total1 = 0;
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $items=[];
                foreach($product_ids as $key=>$value)
                {
                    foreach(Product::where('id','=',$key)->get() as $product)
                    {
                        $item = new Item();
                        $item->setName($product->name)->setCurrency($currency)->setQuantity($value)->setPrice($product->special_price);
                        $items[] = $item;
                        $total1 += $value*$product->special_price;
                    }

                }               
                if($coupon_id!=1)
                {
                    $couponDiscount = new Cost();
                    $couponDiscount->setPercent($percent_off);
                }
                else
                {
                    $couponDiscount = new Cost();
                    $couponDiscount->setPercent(0);
                }
                $shippingAddress=[
                    "recipient_name" =>$shippedTo_firstname. " " .$shippedTo_lastname,
                    "line1" => $shippedTo_address_1,
                    "line2" => $shippedTo_address_2,
                    "city" => $shippedTo_city,
                    "state" =>$shippedTo_state,
                    "postal_code" => $shippedTo_zipcode,
                    "country_code"=>'IN',
                    "phone" => "1234567890",                   
                    ];
                $shoppedItems = new ItemList();
                $shoppedItems->setItems($items);
                $shoppedItems->setShippingAddress($shippingAddress);

                $details = new Details();
                $details->setTax($ecoTax);
                $details->setShipping($shippingCharges);
                $details->setSubtotal($cartSubTotal);
                $details->setShippingDiscount($total-ceil($total-$total*$percent_off/100));
                
                $amount = new Amount();
                $amount->setCurrency($currency)->setTotal($grandTotal)->setDetails($details);


                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($shoppedItems)->setDescription("The payment transaction description.")->setCustom('Discount percentage='.$percent_off);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('status'))->setCancelUrl(URL::route('status'));

                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
                 
                            
                try{
                    $payment->create($this->_api_context);

                }
                catch (\PayPal\Exception\PPConnectionException $ex) 
                {
                    if (\Config::get('app.debug')) 
                    {
                         Session::flash('alert-danger','Connection timeout');
                        return view('frontend.checkout');
                    } 
                    else
                    {
                        Session::flash('alert-danger','Some error occur, sorry for inconvenient');
                        return view('frontend.checkout');
                        /** die('Some error occur, sorry for inconvenient'); **/
                    }
                }

                foreach($payment->getLinks() as $link)
                {
                    if($link->getRel() == 'approval_url')
                    {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                /** add payment ID to session **/
                Session::put('paypal_payment_id', $payment->getId());  
                if(isset($redirect_url))
                {
                        /** redirect to paypal **/
                        return Redirect::away($redirect_url);
                }
                Session::flash('alert_danger','Unknown error occurred');
                return view('frontend.checkout'); 
            }
            $cartDetails="";
            if($coupon_id!=1)
            {
                $coupon_used= new Coupon_used();
                $coupon_used->user_id=$user_id;
                $coupon_used->order_id=$userOrder->id;
                $coupon_used->coupon_id=$coupon_id;
                $coupon_used->save();
                DB::table('coupons')->where('id','=',$coupon_id)->decrement('no_of_uses',1);
            }
             $i=1;
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
                    DB::table('products')->where('id',$product->id)->decrement('quantity',$quantity);

                    $cartDetails.="<tr><td>".$i."</td><td>".$product->name."</td><td>".$product->special_price."</td><td>".$quantity."</td><td>".$quantity*$product->special_price."</td></tr>";
                }
                $i++;
            }

            $orderDetailsView="<table border='1' style='border-collapse: collapse; width:80%; align:center'><tr><td>Sr.No.</td><td>Item</td><td>Price</td><td>Quantity</td><td>Total</td></tr>".$cartDetails."</table>";

            

            //send email notification of order to customer
            $template=Email_template::where('title','=','orderDetails')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{id}",$userOrder->id,$content);
            $content=str_replace("{date}",date("Y-m-d H:i:s"),$content);
            $content=str_replace("{orderDetails}",$orderDetailsView,$content);
            $content=str_replace("{total}",$orderSummaryForEmailView,$content);
            $content=str_replace("{billed_to}",$billingAddress,$content);
            $content=str_replace("{shipped_to}",$shippingAddress,$content);
            $content=str_replace("{paymentMethod}",$paymentMethod,$content);

            Mail::send([],[], function($message) use ($content,$subject,$request,$emailId)
            {
                $message->to($emailId)->cc('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
            });
            setcookie('checkOutData',null,time()-3600);
            if(Auth::user())
            {
                setcookie(Auth::user()->firstname.Auth::user()->id,null,time()-3600,'/');
            }
            else
            {
                setcookie("cartItems",null,time()-3600,'/');
            }
            Session::flash('alert-success', "Order successfully placed!! Thank you.");
            return redirect("/eshopers/home"); 
        }
    }


    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        // Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            // echo 'hi';die;
            Session::flash('alert-danger','Payment failed');

            return redirect('/eshopers/checkout');
        }
        $payment = Payment::get($payment_id, $this->_api_context);

        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/         
        $result = $payment->execute($execution, $this->_api_context);  
        if ($result->getState() == 'approved') 
        {
            $userOrderId=Session::get('userOrderId');                     
            $order=User_order::findOrFail($userOrderId);            
            $order->transaction_id=$payment_id;
            $order->status="o";     
            $order->save();

            $billingAddress=Session::get('billingAddress');
            $shippingAddress=Session::get('shippingAddress');
            $orderSummaryForEmailView=Session::get('orderSummaryForEmailView');
            $payment_gatewayId=Session::get('payment_gateway_id');            
            $coupon_id=Session::get('coupon_id');
            $user_id=Session::get('user_id');
            $product_ids=Session::get('product_ids');
            $emailId=Session::get('emailId');
            $paymentMethod=Session::get('paymentMethod');   

            $cartDetails="";
            if($coupon_id!=1)
            {
                $coupon_used= new Coupon_used();
                $coupon_used->user_id=$user_id;
                $coupon_used->order_id=$userOrderId;
                $coupon_used->coupon_id=$coupon_id;
                $coupon_used->save();
                DB::table('coupons')->where('id','=',$coupon_id)->decrement('no_of_uses',1);
            }
             $i=1;
            foreach($product_ids as $product_id => $quantity)
            {                 
                foreach(Product::where('id','=',$product_id)->get() as $product)
                {
                    $orderDetails= new Order_detail();
                    $orderDetails->order_id=$userOrderId;
                    $orderDetails->product_id=$product->id;
                    $orderDetails->quantity=$quantity;
                    $orderDetails->ammount=$quantity*$product->special_price;
                    $orderDetails->save();

                DB::table('products')->where('id',$product->id)->decrement('quantity',$quantity);

                    $cartDetails.="<tr><td>".$i."</td><td>".$product->name."</td><td>".$product->special_price."</td><td>".$quantity."</td><td>".$quantity*$product->special_price."</td></tr>";
                }
                $i++;
            }

            $orderDetailsView="<table border='1' style='border-collapse: collapse; width:80%; align:center'><tr><td>Sr.No.</td><td>Item</td><td>Price</td><td>Quantity</td><td>Total</td></tr>".$cartDetails."</table>";

            

            //send email notification of order to customer
            $template=Email_template::where('title','=','orderDetails')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{id}",$userOrderId,$content);
            $content=str_replace("{date}",date("Y-m-d H:i:s"),$content);
            $content=str_replace("{orderDetails}",$orderDetailsView,$content);
            $content=str_replace("{total}",$orderSummaryForEmailView,$content);
            $content=str_replace("{billed_to}",$billingAddress,$content);
            $content=str_replace("{shipped_to}",$shippingAddress,$content);
            $content=str_replace("{paymentMethod}",$paymentMethod,$content);

            Mail::send([],[], function($message) use ($content,$subject,$request,$emailId)
            {
                $message->to($emailId)->cc('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
            });
            setcookie('checkOutData',null,time()-3600);
            if(Auth::user())
            {
                setcookie(Auth::user()->firstname.Auth::user()->id,null,time()-3600,'/');
            }
            else
            {
                setcookie("cartItems",null,time()-3600,'/');
            }
            Session::flash('alert-success', "Order successfully placed!! Thank you.");
            return redirect("/eshopers/home"); 
        }
        else{
            Session::put('Invoice_error','Payment failed');
            return view('Frontend.checkout.paypal');

        }
    }
}

