@extends('admin.dashboard.index')
@section('contentHeader')
    <h1>
        Queries
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/contactUs"><i class="fa fa-dashboard"></i>Queries</a></li>
        <li class="active">Update {{ $contactus->id }}</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">contactU {{ $contactus->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/contactUs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       <!--  <a href="{{ url('/admin/contactUs/' . $contactus->id . '/edit') }}" title="Edit contactU"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                        <form method="POST" action="{{ url('admin/contactUs' . '/' . $contactus->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete contactU" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $contactus->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $contactus->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $contactus->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Contact No </th>
                                        <td> {{ $contactus->contact_no }} </td>
                                    </tr>
                                    <tr>
                                        <th> Meesage</th>
                                        <td> {{ $contactus->message }} </td>
                                    </tr>
                                    <tr>
                                        <th>Note to Admin </th>
                                        <td> {{ $contactus->note_admin }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
