@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Order Management
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/orderManagement"><i class="fa fa-dashboard"></i>Order Management</a></li>
        <li class="active">Update @foreach($ordermanagement as $order){{ $order->id }}@endforeach</li>
    </ol>
@endsection
@section('content')
    @php
    $subTotal=0;
    $order_id=0;
    $ecoTax=2;
    foreach($ordermanagement as $order)
    {
        $order_id=$order->id;
    }
    @endphp
    <div class="container">
        
        
        <div class="row">            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">orderManagement {{ $order->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/orderManagement') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>                        
                        <form method="POST" action="{{ url('admin/orderManagement' . '/' .$order_id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete orderManagement" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-2">
                                <h3>Billed To:</h3>
                                <span>
                                    @foreach($ordermanagement as $order)
                                   <b> {{$order->billed_to_name}}</b><br>
                                    {{$order->billing_address_1}},<br>
                                    {{$order->billing_address_2}},<br>
                                    {{$order->billing_city}},{{$order->billing_state}},<br>{{$order->billing_country}}- {{$order->billing_zipcode}}
                                    @endforeach
                                </span>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3">
                                <h3> Shipped To:</h3>
                                <span>
                                    @foreach($ordermanagement as $order)
                                    <b>{{$order->shipped_to_name}}</b><br>
                                    {{$order->shipping_address_1}},<br>
                                    {{$order->shipping_address_2}},<br>
                                    {{$order->shipping_city}},{{$order->shipping_state}},<br>{{$order->shipping_country}}- {{$order->shipping_zipcode}}
                                    @endforeach
                                </span>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <h3>Current Status of Order:</h3>
                                    <span> 
                                        <b> @foreach($ordermanagement as $order)
                                                @if($order->status=="p") Pending
                                                @elseif($order->status=="o") Proccessing
                                                @elseif($order->status=="s") Shipped
                                                @elseif($order->status="d") Delivered
                                                @endif
                                            @endforeach
                                        </b>
                                    </span>
                                    <br>
                                </div>
                                <div class="row">
                                    <h4>Change Status:</h4>
                                    <form action="{{'/admin/changeOrderStatus/'.$order_id}}" method="post">
                                        {{csrf_field()}}
                                        <select name="status">
                                            <option value="p">Pending</option>
                                            <option value="o">Proccessing</option>
                                            <option value="s">Shipped</option>
                                            <option value="d">Delivered</option>
                                        </select>
                                        <span>
                                            <button type="submit" class="btn btn-warning"> <i class="fa fa-refresh" aria-hidden="true"></i></button>
                                        </span>
                                    </form>
                                </div>
                                
                            </div>                            
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <th class="image">Item</th>
                                        <th class="description">Name</th>
                                        <th class="price">Price</th>
                                        <th class="quantity">Quantity</th>
                                        <th class="total">Total</th>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ordermanagement as $order)
                                @foreach(App\Order_detail::where('order_id','=',$order->id)->get() as $orderDetail)
                                @foreach(App\Product::with('product_image')->where('id','=',$orderDetail->product_id)->get() as $product)
                                <tr style="vertical-align: center">
                                    <td>
                                        <img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" style="height:100px; width: 100px">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->special_price}}</td>
                                    <td>{{$orderDetail->quantity}}</td>
                                    <td>{{$orderDetail->ammount}}</td>
                                    @php 
                                        $subTotal=$subTotal+$orderDetail->ammount;
                                    @endphp
                                </tr>
                                @endforeach
                                @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 table-responsive">
                <h3>Payment Details:</h3>
                <table class="table table-condensed">                    
                    @foreach($ordermanagement as $order)
                       <tr>
                            <th>Payment Gateway:</th>
                            <td> @if($order->payment_gateway_id=='1') Cash On delievery @else payPal @endif</td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td> @if($order->payment_gateway_id=='1') NA @else {{$order0->transaction_id}}@endif</td>
                        </tr>
                        <tr>
                            <th>subTotal</th>
                            <td>${{$subTotal}}</td>
                        </tr>
                        <tr>
                            <th>Eco Tax</th>
                            <td>${{$ecoTax}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{$subTotal + $ecoTax}}</td>
                        </tr>
                        <tr>
                            <th> Coupon apply?</th>
                            <td>@if($order->coupon_id=='1') No @else Yes @endif</td>
                        </tr>
                        @if($order->coupon_id!='1')
                            @foreach(App\Coupon::where('id','=',$order->coupon_id)->get() as $coupon)
                                <tr>
                                    <th>Coupon Discount</th>
                                    <td>{{$coupon->percent_off}}%</td>
                                </tr>
                                <tr>
                                    <th>Grand Total</th>
                                    <td>${{ceil($subTotal+$ecoTax-($subTotal+$ecoTax*$coupon->percent_off/100))}}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <th>Grand Total</th>
                            <td>${{$subTotal + $ecoTax}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Shipping Charges</th>
                            <td>@if($order->shipping_charges=='Free') $0 @else ${{$order->shipping_charges}} @endif</td>
                        </tr>
                        <tr>
                            <th>Final Ammount to be paid</th>
                            <td>${{$order->grand_total}}</td>
                        </tr>                    
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
