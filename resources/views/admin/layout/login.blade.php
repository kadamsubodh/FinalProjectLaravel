<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
		<div class="container-fluid">
			<div class="continer">
				<div class="row" style="background-color:#3C8DBC;">
					<header class="main-header">
		    			<!-- Logo -->
		   				<a href="/index2" class="logo">
		      			<!-- mini logo for sidebar mini 50x50 pixels -->
		      			<span class="logo-mini" style="color:white !important"><b>A</b>LT</span>
		     			 <!-- logo for regular state and mobile devices -->
		     			<span class="logo-lg" style="color:white !important"><b>Admin</b>LTE</span>
		   				</a>
		   			</header>
		   		</div>
		   		<br><br>
		   		<br><br>
				<div class="row">
					<div class="col-sm-offset-4 col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h1>
							</div>
							<div class="flash-message">
							    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
							      @if(Session::has('alert-' . $msg))

							      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							      @endif
							    @endforeach
							</div>
							<div class="panel-body">
								<form action="/doLogin" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
								<div class="form-group">
									<label for="input-username">email</label>
									<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input name="email" value="" placeholder="email" id="input-username" class="form-control" type="email">
									</div>
									<span>{{ $errors->first('email') }}</span>
								</div>
								<div class="form-group">
									<label for="input-password">Password</label>
									<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input name="password" value="" placeholder="Password" id="input-password" class="form-control" type="password">
								</div>
								<span>{{ $errors->first('password') }}</span>
									<span class="help-block"><a href="https://demo.opencart.com/admin/index.php?route=common/forgotten">Forgotten Password</a></span>
								</div>
									<div class="text-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Login</button>
									</div>
									<input name="redirect" value="https://demo.opencart.com/admin/index.php?route=common/login" type="hidden">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>