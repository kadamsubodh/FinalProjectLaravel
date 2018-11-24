@extends('frontend.layouts.frontapp')
@section('title','Track Order')
@section('middleSection')
<div class="container-fluid">
	<div class='container'>
		<div class="row" id="trackOrderStatus">
		</div>
		<div class="row">
			@if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
			<div class="col-sm-offset-4 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #FE980F">
						<h1 class="panel-title"><i class="fa fa-lock"></i>Track Your Order</h1>
					</div>
					<div class="panel-body">
						<form action="/eshopers/changePassword" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="input-username">Email</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="email" value="" placeholder="email" id="trackOrderEmail" class="form-control" type="email">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label for="input-username">Order ID</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="orderId" value="" placeholder="order ID" id="trackOrderOrderId" class="form-control" type="text">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>							
							<div class="text-right">
									<button type="button" class="btn btn-primary" id="trackOrderBtn">Track Order</button>
							
									<a href="/eshopers/home" class="btn btn-primary">Cancel</a>
							</div>									
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="trackOrderStatus">
		</div>
	</div>
</div>
@endsection
