@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Mail Template
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/email_templates"><i class="fa fa-dashboard"></i>Mail Templates</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Email_template #{{ $email_template->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/email_templates') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/email_templates/' . $email_template->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.email_templates.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
