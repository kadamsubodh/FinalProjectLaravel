<!DOCTYPE html>
<html lang="en">
<head>	
    <meta charset="utf-8" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | E-Shopper</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
 -->
	<link href="{{asset('css/all.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->
<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div> -->
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{asset('frontend/images/home/logo.png')}}" alt="" /></a>
						</div>
						<!-- <div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div> -->
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right ">
							<ul class="nav navbar-nav">
								<li class="dropdown">@if(Auth::user())<a href="#"><i class="fa fa-user"></i> {{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>@else <a href="/eshopers/login"><i class="fa fa-user"></i>Account</a> @endif
									@if(Auth::user())
									<ul role="menu" class="sub-menu">				
                                        <li class="dropdown-item"><a href="/eshopers/myOrders">My Orders</a></li>
                                        <li class="dropdown-item"><a href="/eshopers/myProfile">My Profile</a></li>	
										<li class="dropdown-item"><a href="/eshopers/userAddress">Address Book</a></li> 
										<li class="dropdown-item"><a href="/eshopers/passwordChange">Change Password</a></li> 
										<li><a href="/eshopers/logout" class="dropdown-item">Logout</a></li> 
                                    </ul>
                                    @endif
                                </li>
								<li><a href="/eshopers/wishlist"><i class="fa fa-star"></i> Wishlist ( @if(Auth::user()) {{App\User_wish_list::where('user_id','=',Auth::user()->id)->count()}} @else 0 @endif)</a></li>
								<li><a href="/eshopers/cart"><i class="fa fa-shopping-cart"></i> Cart(@if(Auth::user()) @if(isset($_COOKIE[Auth::user()->firstname.Auth::user()->id])) {{count(json_decode($_COOKIE[Auth::user()->firstname.Auth::user()->id],true))}} @else 0 @endif @elseif(isset($_COOKIE['cartItems'])) {{count(json_decode($_COOKIE['cartItems'],true))}} @endif)</a></li>
								@if(!Auth::user()) 
								<li><a href= "/eshopers/login"><i class="fa fa-lock"></i> Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/eshopers/home" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/eshopers/products/all">Products</a></li>	
										<li><a href="/eshopers/cart">Cart</a></li>
                                    </ul>
                                </li> 
								<!-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/eshopers/blogs">Blog List</a></li>
										<li><a href="/eshopers/singleBlog">Blog Single</a></li>
                                    </ul>
                                </li> -->							
								<li><a href="/eshopers/contactUs">Contact Us</a></li>
								<li><a href="/eshopers/trackOrderView">Track Order</a></li>
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	<div class="flash-message">
	    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))
	      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	      @endif
	    @endforeach
	</div>

	@section('middleSection')
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>						
						<div class="carousel-inner">
							<?php $i=0;?>
							@foreach(DB::table('banners')->where('status',1)->inRandomOrder()->limit(3)->get() as $banners)
							<div class="{{($i==0) ?'item active' : 'item'}}">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>{{$banners->banner_name}}</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('frontend/images/home/'.$banners->banner_path)}}" class="girl img-responsive" alt="" />
									
								</div>
								<?php $i++; ?>
							</div>
							@endforeach
						</div>						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@section("categoryMenu")
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php $i=1;?>
							@foreach(DB::table('categories')->where('parent_id',0)->get() as $parentCategory)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="{{'#'.$parentCategory->name.$i}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$parentCategory->name}}
										</a>
									</h4>
								</div>
								<div id="{{$parentCategory->name.$i}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach(DB::table('categories')->where('parent_id',$parentCategory->id)->get() as $category)
											<li><a href="{{'/eshopers/products/'.$category->id}}">{{$category->name }}</a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							<?php $i++;?>
							@endforeach
						</div><!--/category-products-->							
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
						</div><!--/shipping-->
						<div class="shipping text-center">
							@foreach(DB::table('coupons')->where('no_of_uses','>',0)->inRandomOrder()->limit(1)->get() as $coupons)
							<h4>Use Coupon <b> {{$coupons->code}}</b> get <b>{{$coupons->percent_off}} % </b>off</h4>
							@endforeach 
						</div>
					
					</div>
					@show
				</div>
				<!-- END OF SIDE CATEGORY MENU --> 
				<div class="col-sm-9 padding-right">
					@section('content')
					@show
				</div>
			</div>
		</div>
	</section>
	@show
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('frontend/images/home/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('frontend/images/home/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('frontend/images/home/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('frontend/images/home/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('frontend/images/home/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">										
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/admin/about/Terms & Conditions">Terms of Use</a></li>
								<li><a href="/admin/about/Privacy Policies">Privacy Policy</a></li>								
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/admin/about/About Us">Company Information</a></li>				
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="/eshopers/subscribeNewsletter" class="searchform" method="POST" id="subscribe">
								{{csrf_field()}}
								<input type="text" placeholder="Your email address" name="subscriberEmail" form="subscribe"/>
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right" form="subscribe"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © {{Date('Y')}} E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>		
	</footer><!--/Footer-->

  @section('scripts')
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="{{asset('frontend/js/gmaps.js')}}"></script>
	<script src="{{asset('frontend/js/contact.js')}}"></script>	
	<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
  @show
</body>
</html>