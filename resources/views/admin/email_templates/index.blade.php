@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Mail Template
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/index"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">Mail Template</li>
    </ol>
     
@endsection
@section('content')
    <div class="container">
        <div class="row">           
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Email_templates</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/email_templates/create') }}" class="btn btn-success btn-sm" title="Add New Email_template">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/email_templates') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Title</th><th>Subject</th><th>Content</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($email_templates as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->subject }}</td><td>{{ $item->content }}</td>
                                        <td>
                                            <a href="{{ url('/admin/email_templates/' . $item->id) }}" title="View Email_template"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/email_templates/' . $item->id . '/edit') }}" title="Edit Email_template"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/email_templates' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Email_template" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $email_templates->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection