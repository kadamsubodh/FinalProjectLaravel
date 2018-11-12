@extends('frontend.layouts.frontapp')
@section('title','Delivery Address')
@section('middleSection')
<div class="container-fluid">
	<div class="container">
		<div class="row">			
			<div class="col-md-6">
				<div class="row">
					@foreach(App\User_address::with('user')->where('user_id','=',Auth::user()->id)->get() as $user)
					<div class="col-md-12">
						<table border='0'>
							<tr>
								<td>Name: </td>
								<td>{{$user->user['firstname']}} {{$user->user['lastname']}}</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><p>{{$user->address_1}}</p>
									<p>{{$user->address_2}}</p>
									<p>City:{{$user->city}}</p>
									<p>State:{{$user->state}}</p>
									<p>Country:{{$user->country}}</p>
								</td>
							</tr>
						</table>						
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-md-6">
				<div class="bill-to">
					<p>Bill To</p>
					<form action="/eshopers/newAddress" method='post'>
						{{csrf_field()}}
					<div class="form-one">										
						<input type="text" placeholder="First Name *">
						<input type="text" placeholder="Middle Name">
						<input type="text" placeholder="Last Name *">
						<input type="text" placeholder="Address 1 *">
						<input type="text" placeholder="Address 2">
					</div>
					<div class="form-two">					
						<input type="text" placeholder="Zip / Postal Code *">
						<select>
							<option>-- Country --</option>
							<option>United States</option>
							<option>Bangladesh</option>
							<option>UK</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>Ucrane</option>
							<option>Canada</option>
							<option>Dubai</option>
						</select>
						<select>
							<option>-- State / Province / Region --</option>
							<option>United States</option>
							<option>Bangladesh</option>
							<option>UK</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>Ucrane</option>
							<option>Canada</option>
							<option>Dubai</option>
						</select>
						<input type="password" placeholder="Confirm password">
						<input type="text" placeholder="Phone *">
						<input type="text" placeholder="Mobile Phone">
						<input type="text" placeholder="Fax">						
					</div>
				</form>
				</div>
			</div>
	</div>
</div>
@endsection