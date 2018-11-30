@extends('frontend.layouts.frontapp')
@section('title','Track Order')
@section('middleSection')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-1 col-md-9">
			@foreach($cms as $content)			
			{!!$content->content!!}
			@endforeach
		</div>
	</div>
</div>
<br>
@endsection
