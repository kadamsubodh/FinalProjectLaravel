<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\User_order;
use App\Email_template;
use Mail;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
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
            $ordermanagement = User_order::with('user')->latest()->paginate($perPage);
        } else {
            $ordermanagement = User_order::with('user')->latest()->paginate($perPage);
        }

        return view('admin.order-management.index', compact('ordermanagement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.order-management.create');
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
        
        $requestData = $request->all();
        
        User_order::create($requestData);

        return redirect('admin/order-management')->with('flash_message', 'User_order added!');
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
        $ordermanagement = User_order::with('order_detail')->where('id','=',$id)->get();
        

        return view('admin.order-management.show', compact('ordermanagement'));
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
        $ordermanagement = User_order::findOrFail($id);

        return view('admin.order-management.edit', compact('ordermanagement'));
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
        
        $ordermanagement = User_order::findOrFail($id);
        $ordermanagement->update($requestData);

        return redirect('admin/order-management')->with('flash_message', 'User_order updated!');
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
        User_order::destroy($id);

        return redirect('admin/order-management')->with('flash_message', 'User_order deleted!');
    }

    public function changeOrderStatus(Request $request)
    {
        $order_id=$request->order_id;
        $status=$request->status;
        $billing_address="";
        $shipping_address="";
        $paymentMethod="";
        $user_id=0;
        $userEmail="";
        $userName="";
        $orderStatus="";
        $subject="";
        $content="";
        if($status=="p")
        {
            $orderStatus="pending";
        }
        elseif($status=="o")
        {
            $orderStatus="Proccessing";
        }
        elseif($status=="s")
        {
            $orderStatus="Shipped";
        }
        elseif($status=="d") {
            $orderStatus="Delivered";
        }

        $userOrder=User_order::findOrFail($order_id);
        $userOrder->status=$status;
        $userOrder->save();
        if($userOrder)
        {
            foreach(User_order::where('id','=',$order_id)->get() as $order)
            {
                   $billing_address="<span><b>".$order->billed_to_name."</b>,<br>".$order->billing_address_1.",<br>".$order->billing_city.", ".$order->billing_state.",<br>".$order->billing_country."-".$order->billing_zipcode."</span>";

                   $shipping_address="<span><b>".$order->shipped_to_name."</b>,<br>".$order->shipping_address_1.",<br>".$order->shipping_city.", ".$order->shipping_state.",<br>".$order->shipping_country."-".$order->shipping_zipcode."</span>";
                   if($order->payment_gateway_id=='1')
                   {
                    $paymentMethod="Cash on delivery";
                   }
                   else
                   {
                    $paymentMethod="Online payment by payPal";
                   }
                   $user_id=$order->user_id;
            }
            foreach(User::where('id','=',$user_id)->get() as $user)
            {
                $userEmail=$user->email;
                $userName=$user->firstname." ".$user->lastname;
            }
            $template=Email_template::where('title','=','sendOrderStatus')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{userName}",$userName,$content);            
            $content=str_replace("{trackingNumber}",$order_id,$content);
            $content=str_replace("{orderStatus}",$orderStatus,$content);
            $content=str_replace("{billed_to}",$billing_address,$content);
            $content=str_replace("{shipped_to}",$shipping_address,$content);
            $content=str_replace("{paymentMethod}",$paymentMethod,$content);
            Mail::send([],[], function($message) use ($content,$subject,$request,$userEmail)
            {
                $message->to($userEmail)->cc('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
            });
            return redirect("/admin/orderManagement");

        }
    }
}
