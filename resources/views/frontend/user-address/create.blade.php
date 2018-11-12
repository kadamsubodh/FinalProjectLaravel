@extends('frontend.layouts.frontapp')

@section('middleSection')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <div class="card">
                    <div class="card-header"><b><u>Create New userAddress</u></b></div>
                    <div class="card-body">
                        <a href="{{ url('/eshopers/userAddress') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/eshopers/userAddress') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('frontend.user-address.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
