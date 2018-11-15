<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Coupon;
use App\Coupon_used;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $coupons = Coupon::latest()->paginate($perPage);
        } else {
            $coupons = Coupon::latest()->paginate($perPage);
        }

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
       $validate=$request->validate([
        'code'=>'required|alphaNum|min:4|max:8',
        'percent_off'=>'required|regex:/^\d*(\.\d{2})?$/',
        'number_of_uses'=>'required|regex:/^\d*(\.\d{2})?$/',
       ]);
       $code=$request->code;
       $percent_off=$request->percent_off;
       $number_of_uses=$request->number_of_uses;
       $created_by=Auth::user()->id;
       $modify_by=Auth::user()->id;
       $addCoupon=DB::select('call addNewCoupon(?,?,?,?,?)',array($code,$percent_off,$number_of_uses, $created_by,$modify_by));
       return redirect('admin/coupons')->with('flash_message', 'Coupon added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $coupon = Coupon::findOrFail($id);
        $coupon->update($requestData);

        return redirect('admin/coupons')->with('flash_message', 'Coupon updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Coupon::destroy($id);

        return redirect('admin/coupons')->with('flash_message', 'Coupon deleted!');
    }

    // public function isExist(Request $request)
    // {
    //     $code=$request->code;
    //     $check=DB::select('exec checkCode(?)',array($code));
    //     if($check)
    //     {
    //         return true;
    //     }

    // }

    public function getCouponCode()
    {
        $len=8;
        do{
            $string = "";
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
            for($i=0;$i<$len;$i++)
            {
                $string.=substr($chars,rand(0,strlen($chars)),1);
            }
        }while($string == DB::table('coupons')->where('code',$string));
        echo $string;
    }

    public function checkIsCouponUsed(Request $request)
    {
        $coupon_id=0;
        if(isset($_COOKIE['checkOutData']))
        {
           setcookie('checkOutData',null,time()-3600);
           $validate=$request->validate([
                'code'=>'required|alphaNum|min:4|max:8'
            ]);
            $couponCode=$request->code;
            $coupon=Coupon::where('code','=',$couponCode)->get();
            if(count($coupon)>0)
            {            
                foreach($coupon as $code)
                {
                    $coupon_id=$code->id;
                }
                if(Coupon_used::where('coupon_id','=',$coupon_id)->where('user_id','=',Auth::user()->id)->get() !==null)
                {
                    echo $coupon_id;
                }
                else
                {
                    echo "null";
                }
            }
            else
            {
                echo "invalid";
            }
        }
        else
        {
            $validate=$request->validate([
                'code'=>'required|alphaNum|min:4|max:8'
            ]);
            $couponCode=$request->code;
            $coupon=Coupon::where('code','=',$couponCode)->get();
            if(count($coupon)>0)
            {            
                foreach($coupon as $code)
                {
                    $coupon_id=$code->id;
                }
                if(!Auth::user())
                {
                    echo $coupon_id;
                }
                else if(Coupon_used::where('coupon_id','=',$coupon_id)->where('user_id','=',Auth::user()->fisrtname.Auth::user()->id)->get() !==null)
                {
                    echo "null";
                }
                else
                {
                    echo $coupon_id; 
                }
            }
            else
            {
                echo "invalid";
            }
        }
    }

    public function applyCoupon(Request $request)
    {
        $couponId=$request->couponId;
        $grandTotal=$request->grandTotal;
        $shippingCharges=$request->shippingCharges;       
        $subTotal=$request->subTotal;
        $ecoTax=$request->ecoTax;
        $percent_off=0;
        $couponData=Coupon::where('id','=',$couponId)->get();
        foreach ($couponData as $coupon) {
            $percent_off=$coupon->percent_off;
        }
        if($shippingCharges==="Free")
        {
            $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100));
        }
        else
        {
            $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100)+50);
        }
        $checkOutData=[];
        $checkOutData['coupon_id']=$couponId;
        $checkOutData['grandTotal']=$grandTotal;
        $checkOutData['grandTotalAfterCouponApply']=$grandTotalAfterCouponApply;
        $checkOutData['shippingCharges']=$shippingCharges;
        $checkOutData['subTotal']=$subTotal;
        $checkOutData['ecoTax']=$ecoTax;
        $checkOutData['percent_off']=$percent_off;       
        setcookie("checkOutData",json_encode($checkOutData));
        echo "<li>Cart Sub Total <span>$ <span id='subTotal'>".$subTotal."</span></span></li>
                            <li>Eco Tax <span>$<span id='ecoTax'>".$ecoTax."</span></span></li>                            
                            <li>Total <span>$ <span id='grandTotal'>".$grandTotal."</span></span></li>
                            <li>Coupon Discount <span><span id='percent_off'>".$percent_off." %</span></span></li>
          <li>Shipping Cost <span><span id='shippingCharges'>".$shippingCharges."</sapn></span></li><li>Final Ammount <span>$ <span id='finalAmmount'>".$grandTotalAfterCouponApply."</span></span></li>";

    }

    public function updateCartBill(Request $request)
    {
        $sum=$request->sum;
        $shippingCharges=0;           
        $grandTotal=0;
        $grandTotalAfterCouponApply=0;        
        $coupon_id=0;
        $subTotal=0;
        $ecoTax=2;
        $percent_off=0;
        if(isset($_COOKIE['checkOutData']))
        {
            $cookiedata=stripcslashes($_COOKIE['checkOutData']);
            $checkOutData= json_decode($cookiedata,true);
            // foreach($checkOutData as $data)
            // {
            //     $coupon_id=$data['coupon_id'];          

            //     $grandTotal=$checkOutData['grandTotal'];
            //     $grandTotalAfterCouponApply=$checkOutData['grandTotalAfterCouponApply'];
            //     $shippingCharges=$checkOutData['shippingCharges'];
            //     $subTotal=$checkOutData['subTotal'];
            //     $ecoTax=$checkOutData['ecoTax'];
            // }
            extract($checkOutData);
            $coupons=Coupon::where('id','=',$coupon_id)->get();
            foreach($coupons as $coupon)
            {
                $percent_off=$coupon->percent_off;
            }
            $subTotal=$sum;    
            $grandTotal=$sum+$ecoTax;           
            if($grandTotal<500)
            {
                $shippingCharges=50;
                $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100)+$shippingCharges);
            }
            else
            {
                $shippingCharges="Free";
                $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100));
            }
            $checkOutData['coupon_id']=$coupon_id;
            $checkOutData['grandTotal']=$grandTotal;
            $checkOutData['grandTotalAfterCouponApply']=$grandTotalAfterCouponApply;
            $checkOutData['shippingCharges']=$shippingCharges;
            $checkOutData['subTotal']=$subTotal;
            $checkOutData['ecoTax']=$ecoTax;
            $checkOutData['percent_off']=$percent_off;   
            setcookie('checkOutData',null,time()-3600);        
            setcookie('checkOutData',json_encode($checkOutData));
            if(isset($_COOKIE['checkOutData']))
            {
                $cookiedata=stripcslashes($_COOKIE['checkOutData']);
                $checkOutData1= json_decode($cookiedata,true);
            // print_r($checkOutData);exit; 
                extract($checkOutData);
                echo "<li>Cart Sub Total <span>$ <span id='subTotal'>".$subTotal."</span></span></li>
                            <li>Eco Tax <span>$<span id='ecoTax'>".$ecoTax."</span></span></li>                            
                            <li>Total <span>$ <span id='grandTotal'>".$grandTotal."</span></span></li>
                            <li>Coupon Discount <span><span id='percent_off'>".$percent_off." %</span></span></li>
             <li>Shipping Cost <span><span id='shippingCharges'>".$shippingCharges."</sapn></span></li><li>Final Ammount <span>$ <span id='finalAmmount'>".$grandTotalAfterCouponApply."</span></span></li>";            
            }
        }
        else
        {
            $subTotal=$sum;    
            $grandTotal=$sum+$ecoTax;           
            if($grandTotal<500)
            {
                $shippingCharges=50;
                $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100)+$shippingCharges);
            }
            else
            {
                $shippingCharges="Free";
                $grandTotalAfterCouponApply=ceil($grandTotal-($grandTotal*$percent_off/100));
            }
            echo "<li>Cart Sub Total <span>$ <span id='subTotal'>".$subTotal."</span></span></li>
                            <li>Eco Tax <span>$<span id='ecoTax'>".$ecoTax."</span></span></li>                            
                            <li>Total <span>$ <span id='grandTotal'>".$grandTotal."</span></span></li>                            
            <li>Shipping Cost <span>$<span id='shippingCharges'>".$shippingCharges."</sapn></span></li><li>Final Ammount <span>$ <span id='finalAmmount'>".$grandTotalAfterCouponApply."</span></span></li>";
        }
    }

    public function removeCoupon(Request $request)
    {
        setcookie('checkOutData',null,time()-3600);
        return redirect($_SERVER['HTTP_REFERER']);
    }

}
