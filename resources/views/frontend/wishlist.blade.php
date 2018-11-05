@extends('frontend.layouts.frontapp')
@section('title','Cart')
@section('middleSection')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Wish List</li>
				</ol>
			</div>
			<a href="/eshopers/clearWishList" class="btn btn-danger">Empty Wish List</a>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>							
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach(App\User_wish_list::where('user_id','=',Auth::user()->id)->get() as $wishlistProduct)
							@foreach(App\Product::with('product_image')->where('id','=',$wishlistProduct->product_id)->get() as $product)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{'/storage/uploads/'. $product->product_image['image_name']}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$product->name}}</a></h4>
								<p>{{'Web ID: 1089772'.$product->id}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{'/eshopers/removeFromWishList/'.$product->id}}" onclick="return confirm('Are you sure want to remove it from wishlist');"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						@endforeach				
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

@endsection