@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
       CMS
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/orderManagement"><i class="fa fa-dashboard"></i>CMS</a></li>
        <li class="active">Update {{$cm->id}}</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">cm {{ $cm->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/cms') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/cms/' . $cm->id . '/edit') }}" title="Edit cm"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/cms' . '/' . $cm->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete cm" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $cm->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $cm->title }} </td></tr><tr><th> Content </th><td> {{ $cm->content }} </td></tr><tr><th> Meta Title </th><td> {{ $cm->meta_title }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
