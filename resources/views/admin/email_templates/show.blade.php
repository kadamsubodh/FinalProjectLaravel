@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Mail Template
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/mailTemplate"><i class="fa fa-dashboard"></i>Mail Template</a></li>
        <li class="active">Update {{ $email_template->id }}</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row">           
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Email_template {{ $email_template->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/mailTemplate') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/mailTemplate/' . $email_template->id . '/edit') }}" title="Edit Email_template"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/mailTemplate' . '/' . $email_template->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Email_template" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $email_template->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $email_template->title }} </td></tr><tr><th> Subject </th><td> {{ $email_template->subject }} </td></tr><tr><th> Content </th><td> {{ $email_template->content }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
