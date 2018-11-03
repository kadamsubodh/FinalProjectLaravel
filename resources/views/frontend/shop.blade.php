@extends('frontend.layouts.frontapp')
@section('title','Shop')
@section('content')
		<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Features Items</h2>
			@foreach($products as $product)
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" />
									<h2>${{$product->special_price}}</h2>
									<p>{{$product->name}}</p>
									<a href="{{'/eshopers/cart/'.$product->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							<div class="product-overlay">
								<div class="overlay-content">
									<h2>${{$product->special_price}}</h2>
									<p>{{$product->name}}</p>
									<a href="{{'/eshopers/cart/'.$product->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
							</div>
						</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href="{{'/eshopers/addtowishlist/'.$product->id}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								<li><a href="{{'/eshopers/cart/'.$product->id}}"><i class="fa fa-plus-square"></i>Add to compare</a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach					
						<!-- <ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul> -->
						{{$products->links()}}
			</div><!--features_items-->			
@endsection

