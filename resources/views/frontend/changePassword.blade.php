@extends('frontend.layouts.frontapp')
@section('title','Change Password')
@section('middleSection')
<div class="container-fluid">
	<div class='container'>
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
						<h1 class="panel-title"><i class="fa fa-lock"></i>Change Password</h1>
					</div>
					<div class="flash-message">
					    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					      @if(Session::has('alert-' . $msg))

					      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					      @endif
					    @endforeach
					</div>
					<div class="panel-body">
						<form action="/eshopers/changePassword" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="input-username">Current Password</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="current_password" value="" placeholder="current_password" id="input-username1" class="form-control" type="password">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label for="input-username">New Password</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="new_password" value="" placeholder="new_password" id="input-username2" class="form-control" type="password">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label for="input-username">Confirm Password</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="confirm_password" value="" placeholder="confirm_password" id="input-username3" class="form-control" type="password">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="text-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-key"></i>Change Password</button>
							</div>									
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
