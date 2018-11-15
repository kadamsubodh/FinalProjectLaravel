@extends('frontend.layouts.frontapp')
@section('title','Checkout')
@section('middleSection')
<section id="cart_items">
		<form name="chekOutForm" action="/eshopers/placeOrder" method="post">
					{{csrf_field()}}
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
						
				<div class="step-one">
					<h2 class="heading">Checkout</h2>
				</div>
				@if(Auth::user())
					@php
						$userAddresses=App\UserAddress::where('user_id','=',Auth::user()->id)->get();
					@endphp
					@if(count($userAddresses)>0)
						<div class="container-fluid">
							<div class="row">
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
						</div>
					@else					
					<div class="row">							
						<div class="col-sm-5 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">
									<form name="checkOutForm">											
										<input type="text" placeholder="First Name *">
										<input type="text" placeholder="Last Name *">
										<input type="text" placeholder="Email*">					
									</form>
								</div>
								<div class="form-two">
									<form name="checkOutForm">
										<input type="text" placeholder="Address 1 *">
										<input type="text" placeholder="Address 2">				
										<input type="text" placeholder="city*">
										<input type="text" placeholder="state*">
										<input type="text" placeholder="country*">
										<input type="text" placeholder="zipcode*">				
									</form>											
								</div>
							</div>
						</div>
					</div>
				@endif		
			@else
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="radio" value="register" name="checkOutOption" class="checkOutOption" checked> Register Account</label>
					</li>
					<li>
						<label><input type="radio" value="guest" name="checkOutOption" class="checkOutOption"> Guest Checkout</label>
					</li>
					<li>
						<label><input type="radio" value="user" name="checkOutOption" class="checkOutOption">Sign In</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->			
			<div class="register-req">
				<p>If you already have an account please sign in or use Register And Checkout to easily get access to your order history, or use Checkout as Guest </p>
			</div><!--/register-req-->
			@endif
			<div class="container-fluid" id="cartCheckOutLogin">
				<div class="row">
					<div class="login-form col=md-offset-6 col-md-6"><!--login form-->
						<h2>Login to your account</h2>
						<form action="/eshopers/signin" method="post" name="loginform">
							{{csrf_field()}}
							<input type="email" placeholder="Email" name='email' form="loginform" />
							<input type="password" placeholder="Password" name='password' form="loginform" />
							<span>
								<input type="checkbox" class="checkbox" form="loginform"> 
								Keep me signed in &nbsp&nbsp<a href="/eshopers/forgetpassword">Forget Password</a>
							</span>
							<button type="submit" class="btn btn-default" form="loginform">Login</button>
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
			<div class="shopper-informations">	
			@if(!Auth::user())						
				<div class="row">							
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form name="checkOutForm">											
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Email*">
									<input type="password" placeholder="Password" id="password">		
									<input type="password" placeholder="Confirm password" id="confirm_password">
								</form>
							</div>
							<div class="form-two">
								<form name="checkOutForm">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">					
									<input type="text" placeholder="city*">
									<input type="text" placeholder="state*">
									<input type="text" placeholder="country*">
									<input type="text" placeholder="zipcode*">					
								</form>											
							</div>
						</div>
					</div>
				</div>
			@endif
				<div class="row">
					<label><input type="checkbox" id="isShippingAddressIsSame" value="same" name="isShippingAddressIsSame" onclick="isShippingAddressIsSame()"> Shipping to bill address</label>	
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="order-message">
							<div class="bill-to" id="shippingAddress">
								<p>Shipped To</p>
								<div class="form-one">
									<form name="checkOutForm">											
										<input type="text" placeholder="First Name *">
										<input type="text" placeholder="Last Name *">
										<input type="text" placeholder="Email*">				
									</form>
								</div>
								<div class="form-two">
									<form name="checkOutForm">
										<input type="text" placeholder="Address 1 *">
										<input type="text" placeholder="Address 2">				
										<input type="text" placeholder="city*">
										<input type="text" placeholder="state*">
										<input type="text" placeholder="country*">
										<input type="text" placeholder="zipcode*">
									</form>											
								</div>
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
	</form>
	</section> <!--/#cart_items-->
	@endsection