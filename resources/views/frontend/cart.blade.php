@extends('frontend.layouts.frontapp')
@section('title','Cart')
@section('middleSection')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<a href="/eshopers/clearCart" class="btn btn-danger">Empty Cart</a>
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
									<input class="cart_quantity_input quantityOfProduct{{$product->id}}"" type="text" name="quantity" value="{{$quantity}}" autocomplete="off" size="2"  readonly='true'>
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
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<label><b><h3>Use Coupon Code</h3></b></label>
							</li>
							<li><input type="text" name="couponCode" id ="couponCode"/> <button type="button" id="applyCoupon" class="btn btn-warning"> Apply</button></li>
						</ul>
						<span class="text-danger" id="couponText"></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul  class="cartBill">
							<li>Cart Sub Total <span>$ <span id="subTotal"></span></span></li>
							<li>Eco Tax <span>$<span id="ecoTax">2</span></span></li>							
							<li>Total <span>$ <span id="grandTotal"></span></span></li>
							<li>Shipping Cost <span id="shippingCharges"></span></li>
						</ul>
						@if(isset($_COOKIE['checkOutData']))
							<a class="btn btn-default update" href="/eshopers/removeCoupon">Remove Applied Coupon</a>
						@endif
							<a class="btn btn-default check_out" href="/eshopers/checkout">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	@endsection
