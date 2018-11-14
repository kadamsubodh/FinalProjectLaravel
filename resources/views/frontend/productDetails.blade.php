@extends('frontend.layouts.frontapp')
@section('title','Product Details')
@section('content')
@foreach($productDetails as $product)
<form action="{{'/eshopers/cart/'.$product->id}}" method="POST">
	{{csrf_field()}}
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			<div class="view-product">
				<img src="{{'/storage/uploads/'.$product->product_image['image_name']}}" alt="" />
				<h3>ZOOM</h3>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
				<h2>{{$product->name}}</h2>
				<p>{{'Web ID: 1089772'.$product->id}}</p>
				<img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
				<span>
					<span>US ${{$product->special_price}}</span>
					<label>Quantity:</label>
					<input type="text" value="{{$quantity}}" name='quantity' placeholder="qty" />
					<button type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</span>
				<p><b>Availability:</b> In Stock</p>
				<p><b>Condition:</b> New</p>
				<p><b>Brand:</b> E-SHOPPER</p>
				<a href=""><img src="{{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->
</form>
	@endforeach
	<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li  class="active" ><a href="#details" data-toggle="tab">Details</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-2">
											<b>Description:</b>
										</div>
										<div class="col-md-4">
											{{$product->long_description}}
										</div>
									</div>
								</div>
							</div>
						</div>			
							
					</div><!--/category-tab-->
	<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								@for ($i = 0; $i < 3; $i++)
								<div class="{{($i==0) ?'item active' : 'item'}}">
								@foreach(App\Product::with('product_image')->inRandomOrder()->limit(3)->where('product_status',1)->get() as $products)	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{'/storage/uploads/'.$products->product_image['image_name']}}" alt="" />
													<h2>${{$products->special_price}}</h2>
													<p>{{$products->name}}</p>
													<a href="{{'/eshopers/cart/'.$products->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								@endforeach									
								</div>
								@endfor								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection
					
				