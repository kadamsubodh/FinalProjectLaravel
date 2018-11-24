@extends('frontend.layouts.frontapp')
@section('title','Checkout')
@section('middleSection')
<section id="cart_items">	
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			 @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif						
			<div class="step-one">
				<h2 class="heading">Checkout</h2>
			</div>					
			@if(Auth::user())
			<div class="container-fluid">
				<form action="/eshopers/placeOrder" name="checkOutForm" method="POST" class="login-form1" id="checkOutForm">
				{{csrf_field()}}
				@php
					$userAddresses=App\UserAddress::where('user_id','=',Auth::user()->id)->get();
				@endphp
				@if(count($userAddresses)>0)
					<div class="bill-to">				
						<p><h3>Bill To:</h3></p>
					</div>
					<div class="row">
						@foreach($userAddresses as $userAddress)
							<div class="col-md-3 step-one">
								<table class="heading table-responsive">
									<tr>
										<td><input type="radio" name="address" value="{{$userAddress->id}}"/></td>
										<td><h3><b>{{$userAddress->address_1}}</b><br>
											{{$userAddress->address_2}},<br>
											{{$userAddress->city}}, {{$userAddress->state}},<br>
											{{$userAddress->country}}- {{$userAddress->zipcode}}
											</h3>
										</td>
									</tr>
								</table>
							</div>
						@endforeach
					</div>
					<a href="/eshopers/userAddress/create" class="btn btn-default update">Add New Address</a>
				@else					
					<div class="row">							
						<div class="col-sm-5 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">											
									<input type="text" placeholder="First Name *" name="billedTo_firstname" value="{{old('billedTo_firstname')}}">
									<input type="text" placeholder="Last Name *" name="billedTo_lastname" value="{{old('billedTo_lastname')}}">									
								</div>
								<div class="form-two">
									
										<input type="text" placeholder="Address 1 *" name="billedTo_address_1" value="{{old('billedTo_address_1')}}">
										<input type="text" placeholder="Address 2" name="billedTo_address_2" value="{{old('billedTo_address_2')}}">				
										<input type="text" placeholder="city*" name="billedTo_city" value="{{old('billedTo_city')}}">
										<input type="text" placeholder="state*" name="billedTo_state" value="{{old('billedTo_state')}}">
										<input type="text" placeholder="country*" name="billedTo_country" value="{{old('billedTo_country')}}">
										<input type="text" placeholder="zipcode*" name="billedTo_zipcode" value="{{old('billedTo_zipcode')}}">	
								</div>
							</div>
						</div>
					</div>
				@endif
				<div class="row">
					<label>Shipping to bill address: <input type="radio" class="isShippingAddressIsSame" value="yes" name="isShippingAddressIsSame"> Yes <input type="radio" class="isShippingAddressIsSame" value="no" name="isShippingAddressIsSame" checked>No </label>	
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="order-message">
							<div class="bill-to shippingAddress">
								<p>Shipped To</p>
								<div class="form-one">									
										<input type="text" placeholder="First Name *" name="shippedTo_firstname" value="{{old('shippedTo_firstname')}}">
										<input type="text" placeholder="Last Name *" name="shippedTo_lastname" value="{{old('shippedTo_lastname')}}">									
								</div>
								<div class="form-two">									
										<input type="text" placeholder="Address 1 *"  name="shippedTo_address_1" value="{{old('shippedTo_address_1')}}">
										<input type="text" placeholder="Address 2"  name="shippedTo_address_2" value="{{old('shippedTo_address_2')}}">				
										<input type="text" placeholder="city*" name="shippedTo_city" value="{{old('shippedTo_city')}}">
										<input type="text" placeholder="state*" name="shippedTo_state" value="{{old('shippedTo_state')}}">
										<input type="text" placeholder="country*" name="shippedTo_country" value="{{old('shippedTo_country')}}">
										<input type="text" placeholder="zipcode*" name="shippedTo_zipcode" value="{{old('shippedTo_zipcode')}}">			
								</div>
							</div>				
						</div>	
					</div>						
				</div>
				<div class="review-payment">
					<h2>Review & Payment</h2>
				</div>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description"></td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($product_ids as $product_id => $quantity)
							@foreach(App\Product::with('product_image')->where('id','=',$product_id)->get() as $product)
							<tr class="user">
								<td class="cart_product">
									<a href="{{'/eshopers/productDetails/'.$product->id}}"><img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" style="height:100px; width: 100px"></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$product->name}}</a></h4>
									<p>{{'Web ID: 1089772'.$product->id}}</p>
								</td>
								<td class="cart_price">
									<p>$<spnan id="{{'priceOfProductNo'.$product->id}}">{{$product->special_price}}</spnan></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_down" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'removeOne'.$product->id}}"> - </a>
										{{csrf_field()}}						
										<input class="cart_quantity_input quantityOfProduct{{$product->id}}" type="text" name="quantity" value="{{$quantity}}" autocomplete="off" size="2" readonly='true'>
										<a class="cart_quantity_up" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'addOne'.$product->id}}"> + </a>	
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$<spnan class="{{'totalPriceOfProductNo'.$product->id}}">{{$product->special_price * $quantity}}</spnan></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{'/eshopers/removeFromCart/'.$product_id}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
							@endforeach						
						</tbody>
					</table>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul class="cartBill">
							<li>Cart Sub Total <span>$ <span id="subTotal"></span></span></li>
							<li>Eco Tax <span>$<span id="ecoTax">2</span></span></li>				
							<li>Total <span>$ <span id="grandTotal"></span></span></li>
							<li>Shipping Cost <span id="shippingCharges"></span></li>
						</ul>
						<ul class="signIn">				
							<li>Payment Mode <span id="paymentBy">Cash on Delivery</span></li>
						</ul>
						@if(isset($_COOKIE['checkOutData']))
							<a class="btn btn-default update" href="/eshopers/removeCoupon">Remove Applied Coupon</a>
						@endif
							<button class="btn btn-default check_out place_order">Place Order</button>				
						</div>
				</div>				
				<div class="payment-options">
					@foreach(App\Payment_gateway::all() as $payementGateway)
					<span>
						<label><input type="radio" value="{{$payementGateway->id}}" name="paymentMode"> {{$payementGateway->name}}</label>
						
					</span>
					@endforeach					
					<!-- <span>
						<label><input type="radio" value="payPal" name="paymentMode"> Paypal</label>
					</span> -->
				</div>
			</form>
			</div>				
			@else
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="radio" value="newRegister" name="checkOutOption" class="checkOutOption" form="newRegisterForm" checked> Register Account</label>
					</li>
					<li>
						<label><input type="radio" value="guest" name="checkOutOption" class="checkOutOption" form="newRegisterForm"> Guest Checkout</label>
					</li>
					<li>
						<label><input type="radio" value="signIn" name="checkOutOption" class="checkOutOption" form="newRegisterForm">Sign In</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->	
				<div class="container-fluid" id="newRegister">
					<form action="/eshopers/placeOrder" name="newRegister" method="POST" class="login-form1" id="newRegisterForm">
					{{csrf_field()}}									
						<div class="register-req">
							<p>If you already have an account please sign in or use Register And Checkout to easily get access to your order history, or use Checkout as Guest </p>
						</div><!--/register-req-->
						<div class="row">							
							<div class="col-sm-5 clearfix">
								<div class="bill-to">
									<p>Bill To</p>
									<div class="form-one">											
											<input type="text" placeholder="First Name *" name="billedTo_firstname" value="{{old('billedTo_firstname')}}">
											<input type="text" placeholder="Last Name *" name="billedTo_lastname" value="{{old('billedTo_lastname')}}">
											<input type="text" placeholder="Email*" name="billedTo_email" value="{{old('billedTo_email')}}">
											<input type="password" placeholder="Password" id="password" name="billedTo_password">		
											<input type="password" placeholder="Confirm password" id="confirm_password" name="billedTo_confirm_password">		
									</div>
									<div class="form-two">											
											<input type="text" placeholder="Address 1 *" name="billedTo_address_1" value="{{old('billedTo_address_1')}}"> 
											<input type="text" placeholder="Address 2" name="billedTo_address_2" value="{{old('billedTo_address_2')}}">					
											<input type="text" placeholder="city*" name="billedTo_city" value="{{old('billedTo_city')}}">
											<input type="text" placeholder="state*" name="billedTo_state" value="{{old('billedTo_state')}}">
											<input type="text" placeholder="country*" name="billedTo_country" value="{{old('billedTo_country')}}">
											<input type="text" placeholder="zipcode*" name="billedTo_zipcode" value="{{old('billedTo_zipcode')}}">								
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label>Shipping to bill address:
							 <input type="radio" class="isShippingAddressIsSame" value="yes" name="isShippingAddressIsSame"> Yes 
							 <input type="radio" class="isShippingAddressIsSame" value="no" name="isShippingAddressIsSame" checked>No </label>	
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="order-message">
									<div class="bill-to shippingAddress">
										<p>Shipped To</p>
										<div class="form-one">									
											<input type="text" placeholder="First Name *" name="shippedTo_firstname" value="{{old('shippedTo_firstname')}}">
											<input type="text" placeholder="Last Name *" name="shippedTo_lastname" value="{{old('shippedTo_lastname')}}">									
										</div>
										<div class="form-two">									
											<input type="text" placeholder="Address 1 *"  name="shippedTo_address_1" value="{{old('shippedTo_address_1')}}">
											<input type="text" placeholder="Address 2"  name="shippedTo_address_2" value="{{old('shippedTo_address_2')}}">				
											<input type="text" placeholder="city*" name="shippedTo_city" value="{{old('shippedTo_city')}}">
											<input type="text" placeholder="state*" name="shippedTo_state" value="{{old('shippedTo_state')}}">
											<input type="text" placeholder="country*" name="shippedTo_country" value="{{old('shippedTo_country')}}">
											<input type="text" placeholder="zipcode*" name="shippedTo_zipcode" value="{{old('shippedTo_zipcode')}}">			
										</div>
									</div>				
								</div>	
							</div>
						</div>
						<div class="review-payment">
							<h2>Review & Payment</h2>
						</div>
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Item</td>
										<td class="description"></td>
										<td class="price">Price</td>
										<td class="quantity">Quantity</td>
										<td class="total">Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@foreach($product_ids as $product_id => $quantity)
									@foreach(App\Product::with('product_image')->where('id','=',$product_id)->get() as $product)
									<tr class="register">
										<td class="cart_product">
											<a href="{{'/eshopers/productDetails/'.$product->id}}"><img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" style="height:100px; width: 100px"></a>
										</td>
										<td class="cart_description">
											<h4><a href="">{{$product->name}}</a></h4>
											<p>{{'Web ID: 1089772'.$product->id}}</p>
										</td>
										<td class="cart_price">
											<p>$<spnan id="{{'priceOfProductNo'.$product->id}}">{{$product->special_price}}</spnan></p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<a class="cart_quantity_down" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'removeOne'.$product->id}}"> - </a>
												{{csrf_field()}}						
												<input class="cart_quantity_input quantityOfProduct{{$product->id}}" type="text" name="quantity" value="{{$quantity}}" autocomplete="off" size="2" readonly='true'>
												<a class="cart_quantity_up" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'addOne'.$product->id}}"> + </a>	
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">$<spnan class="{{'totalPriceOfProductNo'.$product->id}}">{{$product->special_price * $quantity}}</spnan></p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{'/eshopers/removeFromCart/'.$product_id}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach
									@endforeach						
								</tbody>
							</table>
						</div>
						<div class="col-sm-6">
							<div class="total_area">
								<ul class="cartBill">
									<li>Cart Sub Total <span>$ <span id="subTotal"></span></span></li>
									<li>Eco Tax <span>$<span id="ecoTax">2</span></span></li>				
									<li>Total <span>$ <span id="grandTotal"></span></span></li>
									<li>Shipping Cost <span id="shippingCharges"></span></li>				
								</ul>
								<ul class="register">
									<li>Payment Mode <span id="paymentBy">Cash on Delivery</span></li>
								</ul>
								@if(isset($_COOKIE['checkOutData']))
									<a class="btn btn-default update" href="/eshopers/removeCoupon">Remove Applied Coupon</a>
								@endif
								<button class="btn btn-default check_out place_order">Place Order</button>		
							</div>
						</div>				
						<div class="payment-options">
							@foreach(App\Payment_gateway::all() as $payementGateway)
							<span>
								<label><input type="radio" value="{{$payementGateway->id}}" name="paymentMode"> {{$payementGateway->name}}</label>
							</span>
							@endforeach	
						</div>
					</form>						
				</div>
				<div class="container-fluid" id="guest" style="display: none">
					<form action="/eshopers/placeOrder" name="guest" method="POST" class="login-form1" id="guestForm">
					{{csrf_field()}}								
				<div class="register-req">
					<p>If you already have an account please sign in or use Register And Checkout to easily get access to your order history, or use Checkout as Guest </p>
				</div><!--/register-req-->
						<div class="row">							
							<div class="col-sm-5 clearfix">
								<div class="bill-to">
									<p>Bill To</p>
									<div class="form-one">											
											<input type="text" placeholder="First Name *" name="billedTo_firstname" value="{{old('billedTo_firstname')}}">
											<input type="text" placeholder="Last Name *" name="billedTo_lastname" value="{{old('billedTo_lastname')}}">
											<input type="text" placeholder="Email*" name="billedTo_email" value="{{old('billedTo_email')}}">					
									</div>
									<div class="form-two">														
											<input type="text" placeholder="Address 1 *" name="billedTo_address_1" value="{{old('billedTo_address_1')}}"> 
											<input type="text" placeholder="Address 2" name="billedTo_address_2" value="{{old('billedTo_address_2')}}">					
											<input type="text" placeholder="city*" name="billedTo_city" value="{{old('billedTo_city')}}">
											<input type="text" placeholder="state*" name="billedTo_state" value="{{old('billedTo_state')}}">
											<input type="text" placeholder="country*" name="billedTo_country" value="{{old('billedTo_country')}}">
											<input type="text" placeholder="zipcode*" name="billedTo_zipcode" value="{{old('billedTo_zipcode')}}">
									
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label>Shipping to bill address: <input type="radio" class="isShippingAddressIsSame" value="yes" name="isShippingAddressIsSame"> Yes <input type="radio" class="isShippingAddressIsSame" value="no" name="isShippingAddressIsSame" checked>No </label>	
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="order-message">
									<div class="bill-to shippingAddress">
										<p>Shipped To</p>
										<div class="form-one">									
											<input type="text" placeholder="First Name *" name="shippedTo_firstname" value="{{old('shippedTo_firstname')}}">
											<input type="text" placeholder="Last Name *" name="shippedTo_lastname" value="{{old('shippedTo_lastname')}}">								
										</div>
										<div class="form-two">									
											<input type="text" placeholder="Address 1 *"  name="shippedTo_address_1" value="{{old('shippedTo_address_1')}}">
											<input type="text" placeholder="Address 2"  name="shippedTo_address_2" value="{{old('shippedTo_address_2')}}">				
											<input type="text" placeholder="city*" name="shippedTo_city" value="{{old('shippedTo_city')}}">
											<input type="text" placeholder="state*" name="shippedTo_state" value="{{old('shippedTo_state')}}">
											<input type="text" placeholder="country*" name="shippedTo_country" value="{{old('shippedTo_country')}}">
											<input type="text" placeholder="zipcode*" name="shippedTo_zipcode" value="{{old('shippedTo_zipcode')}}">			
										</div>
									</div>				
								</div>	
							</div>
						</div>
						<div class="review-payment">
							<h2>Review & Payment</h2>
						</div>
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Item</td>
										<td class="description"></td>
										<td class="price">Price</td>
										<td class="quantity">Quantity</td>
										<td class="total">Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@foreach($product_ids as $product_id => $quantity)
									@foreach(App\Product::with('product_image')->where('id','=',$product_id)->get() as $product)
									<tr class="guest">
										<td class="cart_product">
											<a href="{{'/eshopers/productDetails/'.$product->id}}"><img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" style="height:100px; width: 100px"></a>
										</td>
										<td class="cart_description">
											<h4><a href="">{{$product->name}}</a></h4>
											<p>{{'Web ID: 1089772'.$product->id}}</p>
										</td>
										<td class="cart_price">
											<p>$<spnan id="{{'priceOfProductNo'.$product->id}}">{{$product->special_price}}</spnan></p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<a class="cart_quantity_down" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'removeOne'.$product->id}}"> - </a>
												{{csrf_field()}}						
												<input class="cart_quantity_input quantityOfProduct{{$product->id}}" type="text" name="quantity" value="{{$quantity}}" autocomplete="off" size="2" readonly='true'>
												<a class="cart_quantity_up" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'addOne'.$product->id}}"> + </a>	
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">$<spnan class="{{'totalPriceOfProductNo'.$product->id}}">{{$product->special_price * $quantity}}</spnan></p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{'/eshopers/removeFromCart/'.$product_id}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach
									@endforeach						
								</tbody>
							</table>
						</div>
						<div class="col-sm-6">
							<div class="total_area">
								<ul  class="cartBill">
									<li>Cart Sub Total <span>$ <span id="subTotal"></span></span></li>
									<li>Eco Tax <span>$<span id="ecoTax">2</span></span></li>				
									<li>Total <span>$ <span id="grandTotal"></span></span></li>
									<li>Shipping Cost <span id="shippingCharges"></span></li>				
								</ul>
								<ul class="guest">
									<li>Payment Mode <span id="paymentBy">Cash on Delivery</span></li>
								</ul>
								@if(isset($_COOKIE['checkOutData']))
									<a class="btn btn-default update" href="/eshopers/removeCoupon">Remove Applied Coupon</a>
								@endif
								<button class="btn btn-default check_out place_order">Place Order</button>		
							</div>
						</div>				
						<div class="payment-options">
							@foreach(App\Payment_gateway::all() as $payementGateway)
							<span>
								<label><input type="radio" value="{{$payementGateway->id}}" name="paymentMode"> {{$payementGateway->name}}</label>
							</span>
							@endforeach
						</div>
					</form>						
				</div>
				<div class="container-fluid" id="signIn" style="display: none">		
					<div class="row">
						<div class="login-form col=md-offset-6 col-md-6"><!--login form-->
							<h2>Login to your account</h2>
							<form action="/eshopers/signin" method="post">
								{{csrf_field()}}
								<input type="email" placeholder="Email" name='email'/>
								<input type="password" placeholder="Password" name='password'/>
								<span>
									<input type="checkbox" class="checkbox"> 
									Keep me signed in &nbsp&nbsp<a href="/eshopers/forgetpassword">Forget Password</a>
								</span>
								<button type="submit" class="btn btn-default update"> Login</button>
								<br/>
								<div calss="row">
									<div class="col-sm-3">
										<a href="/auth/social/facebook" class="btn btn-info"> Facebook <i class="fa fa-facebook"></i></a>
									</div>
									<div class='col-sm-1'></div>
									<div class="col-sm-3">
										<a href="/auth/social/google" class="btn btn-danger"> Google <i class="fa fa-google-plus"></i></a>
									</div>
									<div class='col-sm-1'></div>
									<div class="col-sm-3">
										<a href="/auth/social/twitter" class="btn btn-info"> Twitter <i class="fa fa-twitter"></i></a>
									</div>
									<div class='col-sm-1'></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			@endif
			<!-- <div class="shopper-informations">	
			@if(!Auth::user())						
				<div class="row">							
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
																
									<input type="text" placeholder="First Name *" form="checkOutForm">
									<input type="text" placeholder="Last Name *" form="checkOutForm">
									<input type="text" placeholder="Email*">
									<input type="password" placeholder="Password" id="password" form="checkOutForm">		
									<input type="password" placeholder="Confirm password" id="confirm_password" form="checkOutForm">
								
							</div>
							<div class="form-two">
								
									<input type="text" placeholder="Address 1 *" form="checkOutForm">
									<input type="text" placeholder="Address 2" form="checkOutForm">					
									<input type="text" placeholder="city*" form="checkOutForm">
									<input type="text" placeholder="state*" form="checkOutForm">
									<input type="text" placeholder="country*" form="checkOutForm">
									<input type="text" placeholder="zipcode*" form="checkOutForm">		
								
							</div>
						</div>
					</div>
				</div>
			@endif
									
				</form>	
			</div>			
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($product_ids as $product_id => $quantity)
						@foreach(App\Product::with('product_image')->where('id','=',$product_id)->get() as $product)
						<tr>
							<td class="cart_product">
								<a href="{{'/eshopers/productDetails/'.$product->id}}"><img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" style="height:100px; width: 100px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$product->name}}</a></h4>
								<p>{{'Web ID: 1089772'.$product->id}}</p>
							</td>
							<td class="cart_price">
								<p>$<spnan id="{{'priceOfProductNo'.$product->id}}">{{$product->special_price}}</spnan></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'removeOne'.$product->id}}"> - </a>
									{{csrf_field()}}						
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$quantity}}" autocomplete="off" size="2" id="quantityOfProduct{{$product->id}}" readonly='true'>
									<a class="cart_quantity_up" href="javascript:void(0)" data-id="{{$product->id}}" id="{{'addOne'.$product->id}}"> + </a>	
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<spnan id="{{'totalPriceOfProductNo'.$product->id}}">{{$product->special_price * $quantity}}</spnan></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{'/eshopers/removeFromCart/'.$product_id}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						@endforeach						
					</tbody>
				</table>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul  id="cartBill">
						<li>Cart Sub Total <span>$ <span id="subTotal"></span></span></li>
						<li>Eco Tax <span>$<span id="ecoTax">2</span></span></li>				
						<li>Total <span>$ <span id="grandTotal"></span></span></li>
						<li>Shipping Cost <span id="shippingCharges"></span></li>				
					</ul>
					<ul>
						<li>Payment Mode <span id="paymentBy">Cash on Delivery</span></li>
					</ul>
					@if(isset($_COOKIE['checkOutData']))
						<a class="btn btn-default update" href="/eshopers/removeCoupon">Remove Applied Coupon</a>
					@endif
						<input type="submit" class="btn btn-default check_out" value="Place Order"/>				</div>
			</div>				
			<div class="payment-options">
				<span>
					<label><input type="radio" value="cod" name="paymentMode" checked> Cash on Delievery</label>
				</span>					
				<span>
					<label><input type="radio" value="payPal" name="paymentMode"> Paypal</label>
				</span>
			</div>		
		</div>
	</form> -->
</div>

</section> <!--/#cart_items-->
@endsection