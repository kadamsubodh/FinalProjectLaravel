@extends('admin.dashboard.index')
@section('contentHeader')
      <h1>
      Categories
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/categories"><i class="fa fa-dashboard"></i>Categories</a></li>
        <li class="active">Create</li>
      </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row">
             <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New category</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.categories.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
