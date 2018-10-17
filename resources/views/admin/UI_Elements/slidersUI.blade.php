@extends('admin.layout.app')
@section('head')
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | UI Sliders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="../../plugins/bootstrap-slider/slider.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('bodyTag')
<body class="hold-transition skin-blue sidebar-mini">
@endsection

@section('contentHeader')
	<h1>
    	Sliders
    	<small>range sliders</small>
    </h1>
    <ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    	<li><a href="#">UI</a></li>
    	<li class="active">Sliders</li>
    </ol>
@endsection

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Bootstrap Slider</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row margin">
                <div class="col-sm-6">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">

                  <p>data-slider-id="red"</p>
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">

                  <p>data-slider-id="blue"</p>
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="green">

                  <p>data-slider-id="green"</p>
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="yellow">

                  <p>data-slider-id="yellow"</p>
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="aqua">

                  <p>data-slider-id="aqua"</p>
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="purple">

                  <p style="margin-top: 10px">data-slider-id="purple"</p>
                </div>
                <div class="col-sm-6 text-center">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="green">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="yellow">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="aqua">
                  <input type="text" value="" class="slider form-control" data-slider-min="-200" data-slider-max="200"
                         data-slider-step="5" data-slider-value="[-100,100]" data-slider-orientation="vertical"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="purple">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection

@section('scripts')

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Bootstrap slider -->
<script src="../../plugins/bootstrap-slider/bootstrap-slider.js"></script>
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider()
  })
</script>
@endsection