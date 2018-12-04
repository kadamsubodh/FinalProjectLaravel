@extends('admin.dashboard.index')
@section('contentHeader')
      <h1>
        Banners
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banners</li>
      </ol>
     
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Banners</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/banners/create') }}" class="btn btn-success btn-sm" title="Add New banner">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>                      

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="listTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Banner Name</th><th>Banner Image</th><th>Status</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->banner_name }}</td><td><img class="imageSize" src="{{'/storage/uploads/'.$item->banner_path}}"></td><td>{{ (isset($item) && (1 == $item->status))?'Enable':'Disable' }}</td>
                                        <td>
                                            <a href="{{ url('/admin/banners/' . $item->id) }}" title="View banner"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/banners/' . $item->id . '/edit') }}" title="Edit banner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/banners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $banners->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
