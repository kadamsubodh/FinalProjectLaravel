@extends('frontend.layouts.frontapp')
@section('title','My Orders')
@section('middleSection')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 table-responsive">
			<table class="table table-stripped">
				<thead>
					<tr>
						<th>Order_id</th>
						<th>Billed_To</th>
						<th>Shipped_To</th>
						<th>Grand_Total</th>
						<th>Payment_Mode</th>
						<th>shipping_mehtod</th>
						<th>status</th>
						
					</tr>
				</thead>
				<tbody>
		@foreach(App\User_order::where('user_id','=',Auth::user()->id)->get() as $userOrders)
			<tr>
				<td>{{$userOrders->id}}</td>
				<td>
					<p><b>{{$userOrders->billed_to_name}}</b></p>
					<p>{{$userOrders->billing_address_1}}</p>
					<p>{{$userOrders->billing_address_2}}</p>
					<p>{{$userOrders->billing_city}}, {{$userOrders->billing_state}}</p>
					<p>{{$userOrders->billing_country}}- {{$userOrders->billing_zipcode}}</p>
				</td>
				<td>
					<p><b>{{$userOrders->shipped_to_name}}</b></p>
					<p>{{$userOrders->shipping_address_1}}</p>
					<p>{{$userOrders->shipping_address_2}}</p>
					<p>{{$userOrders->shipping_city}}, {{$userOrders->shipping_state}}</p>
					<p>{{$userOrders->shipping_country}}- {{$userOrders->shipping_zipcode}}</p>
				</td>
				<td>
					${{$userOrders->grand_total}}
				</td>
				<td>
					@if($userOrders->payment_gateway_id==1) COD @else payPal @endif
				</td>
				<td>
					{{$userOrders->shipping_method}}
				</td>
				<td>
					@if($userOrders->status=="p") pending @elseif($userOrders->status=="o")
					processing @elsif($userOrders->status=="s") Shipped @else Delieverd @endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
</div>
@endsection
				
