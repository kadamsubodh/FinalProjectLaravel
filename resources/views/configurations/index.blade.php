@extends('admin.dashboard.index')
@section('contentHeader')
      <h1>
        Configuration
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Configuration</li>
      </ol>
     
@endsection
@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Configurations</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/configurations/create') }}" class="btn btn-success btn-sm" title="Add New configuration">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/configurations') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Conf Key</th><th>Conf Value</th>
                                        <th>Created_By</th><th>Modify_By</th>
                                        <th>Status</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($configurations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->conf_key }}</td><td>{{ $item->conf_value }}</td>
                                        <td>{{App\User::find($item->created_by)->firstname}} {{App\User::find($item->created_by)->lastname}}</td>
                                        <td>{{App\User::find($item->modify_by)->firstname}} {{App\User::find($item->modify_by)->lastname}}</td>
                                        <td>{{ (isset($item) && (1== $item->status) ? 'Enable' : 'Disable') }}</td>
                                        <td>
                                            <a href="{{ url('/admin/configurations/' . $item->id) }}" title="View configuration"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/configurations/' . $item->id . '/edit') }}" title="Edit configuration"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/configurations' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete configuration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $configurations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
