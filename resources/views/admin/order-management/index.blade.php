@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Order Management
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/index"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">Order Management</li>
    </ol>
     
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Ordermanagement</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/orderManagement/create') }}" class="btn btn-success btn-sm" title="Add New orderManagement">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                       <!--  <form method="GET" action="{{ url('/admin/orderManagement') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form> -->

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="listTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Order Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ordermanagement as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{$item->user['firstname']." ".$item->user['lastname']}}
                                        </td>
                                        <td>{{$item->user['email']}}</td>
                                        <td>@if($item->status=='p') Pending @elseif($item->status=='o') Processing
                                            @elseif($item->status=='s') Shipped @elseif($item->status=='d') Delivered @endif
                                        <td>
                                            <a href="{{ url('/admin/orderManagement/' . $item->id) }}" title="View orderManagement"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <!-- <a href="{{ url('/admin/orderManagement/' . $item->id . '/edit') }}" title="Edit orderManagement"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                            <form method="POST" action="{{ url('/admin/orderManagement' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete orderManagement" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $ordermanagement->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
