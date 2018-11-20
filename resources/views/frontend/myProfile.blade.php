@extends('frontend.layouts.frontapp')
@section('title','My Orders')
@section('middleSection')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-6">
			<div class="row">
				<h2>My Account</h2>
			</div>
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href="/eshopers/editMyInfo">Edit Account Information</a>
				</li>
				<li>
					<a href="/eshopers/passwordChange"> Change password</a>
				</li>
				<li>
					<a href="/eshopers/userAddress">My Address Book</a>
				</li>

			</ul> 
			<div class="row">
				<h2>Order History</h2>
			</div>
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href="/eshopers/myOrders">My Orders</a>
				</li>				
			</ul>
			<div class="row">
				<h2>Wish List</h2>
			</div>
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href="/eshopers/wishlist">Wish List</a>
				</li>				
			</ul>
		</div>
	</div>
</div>
@endsection