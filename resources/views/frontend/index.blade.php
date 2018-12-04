@extends('frontend.layouts.frontapp')
@section('content')
				<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach(App\Product::with('product_image')->inRandomOrder()->limit(6)->where('product_status',1)->where('is_featured',1)->get() as $products)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{'/storage/uploads/'.$products->product_image['image_name']}}" alt=""/>
											<h2>${{$products->special_price}}</h2>
											<p>{{$products->name}}</p>
											<a href="{{'/eshopers/cart/'.$products->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>${{$products->special_price}}</h2>
												<p>{{$products->name}}</p>
												<a href="{{'/eshopers/cart/'.$products->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{'/eshopers/addtowishlist/'.$products->id }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="{{'/eshopers/productDetails/'.$products->id}}"><i class="fa fa-plus-square"></i>View Details</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">								
								<li class="active"><a href="#tshirt" data-toggle="tab">T-shirts</a></li>
								<li><a href="#bags" data-toggle="tab">Bags</a></li>				
								<li><a href="#kids" data-toggle="tab">Kids</a></li>				
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt">
								@foreach(App\Product::with('product_image')->inRandomOrder()->limit(4)->where('meta_keywords','like','%tshirt%')->get() as $tshirts )
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="{{'/eshopers/productDetails/'.$tshirts->id}}">
												<img src="{{'/storage/uploads/'.$tshirts->product_image['image_name']}}" alt="" /></a>
												<h2>${{$tshirts->special_price}}</h2>
												<p>{{$tshirts->name}}</p>
												<a href="{{'/eshopers/cart/'.$tshirts->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>											
										</div>
									</div>
								</div>
								@endforeach	
							</div>										
							<div class="tab-pane fade" id="bags" >
								@foreach(App\Product::with('product_image')->inRandomOrder()->limit(4)->where('meta_keywords','like','%bags%')->get() as $bags )
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{'/storage/uploads/'.$bags->product_image['image_name']}}" alt="" />
												<h2>${{$bags->special_price}}</h2>
												<p>{{$bags->name}}</p>
												<a href="{{'/eshopers/cart/'.$bags->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>											
										</div>
									</div>
								</div>
								@endforeach								
							</div>
							
							<div class="tab-pane fade" id="kids" >
								@foreach(App\Product::with('product_image')->inRandomOrder()->limit(4)->where('meta_keywords','like','%kids%')->get() as $kids )
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{'/storage/uploads/'.$kids->product_image['image_name']}}" alt="" />
												<h2>${{$kids->special_price}}</h2>
												<p>{{$kids->name}}</p>
												<a href="{{'/eshopers/cart/'.$kids->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								@endforeach								
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