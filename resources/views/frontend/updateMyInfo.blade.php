@extends('frontend.layouts.frontapp')
@section('title','Edit Profile')
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
						<h1 class="panel-title"><i class="fa fa-lock"></i>Update Profile</h1>
					</div>
					<div class="flash-message">
					    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					      @if(Session::has('alert-' . $msg))

					      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					      @endif
					    @endforeach
					</div>
					<div class="panel-body">
						<form action="/eshopers/updateMyInfo" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							@foreach(App\User::where('id','=',Auth::user()->id)->get() as $user)
							<div class="form-group">
								<label for="input-username">Firstname</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="firstname" value="{{$user->firstname}}" placeholder="firstname" id="input-username1" class="form-control" type="text">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label for="input-username">Lastname</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="lastname" value="{{$user->lastname}}" placeholder="lastname" id="input-username2" class="form-control" type="text">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label for="input-username">Email</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="email" value="{{$user->email}}" placeholder="email" id="input-username3" class="form-control" type="email">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							@endforeach
							<div class="text-right">
									<button type="submit" class="btn btn-primary">Update</button>
									<a href="/eshopers/myProfile" class="btn btn-primary">Cancel</a>
							</div>									
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
