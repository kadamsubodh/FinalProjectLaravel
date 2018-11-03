@extends('frontend.layouts.frontapp')
@section('middleSection')
<div class="container-fluid">
	<div class='container'>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #FE980F">
						<h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your Email</h1>
					</div>
					<div class="flash-message">
					    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					      @if(Session::has('alert-' . $msg))

					      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					      @endif
					    @endforeach
					</div>
					<div class="panel-body">
						<form action="/eshopers/sendMail" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="input-username">Email</label>
								<div class="input-group"><span class="input-group-addon" style="background-color: #FE980F"><i class="fa fa-user"></i></span>
									<input name="email" value="" placeholder="email" id="input-username" class="form-control" type="email">
								</div>
								<span>{{ $errors->first('email') }}</span>
							</div>
							<div class="text-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Send Email</button>
							</div>									
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
