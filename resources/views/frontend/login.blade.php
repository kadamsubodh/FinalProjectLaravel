@extends('frontend.layouts.frontapp')
@section('title','Login')
@section('middleSection')
	<section id="form"><!--form-->
		<div class="container">			
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="flash-message">
					    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					      @if(Session::has('alert-' . $msg))

					      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					      @endif
					    @endforeach
					</div>
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="/eshopers/signin" method="post">
							{{csrf_field()}}
							<input type="email" placeholder="Email" name='email' />
							<input type="password" placeholder="Password" name='password' />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in &nbsp&nbsp<a href="/eshopers/forgetpassword">Forget Password</a>
							</span>
							<button type="submit" class="btn btn-default">Login</button>
							<br/>
							<div calss="row">
								<div class="col-sm-3">
									<a href="/auth/social/facebook" class="btn btn-info"> Facebook <i class="fa fa-facebook"></i></a>
								</div>
								<div class='col-sm-1'></div>
								<div class="col-sm-3">
									<a href="/auth/social/google" class="btn btn-danger"> Google <i class="fa fa-google-plus"></i></a>
								</div>
								<div class='col-sm-1'></div>
								<div class="col-sm-3">
									<a href="/auth/social/twitter" class="btn btn-info"> Twitter <i class="fa fa-twitter"></i></a>
								</div>
								<div class='col-sm-1'></div>
							</div>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="/eshopers/signup" method="post">
							{{csrf_field()}}
							<input type="text" placeholder="Firstname" name='firstname'/>
							{!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
							<input type="text" placeholder="lastname" name='lastname'/>
							{!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
							<input type="email" placeholder="Email Address" name='email'/>{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
							<input type="password" placeholder="Password" name='password'/>{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
							<input type="password" placeholder="Confirm Password" name='confirm_password'>{!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection