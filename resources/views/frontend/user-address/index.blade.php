@extends('frontend.layouts.frontapp')

@section('middleSection')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <div class="card">
                    <div class="card-header"><b><u>User Address</u></b></div>
                    <div class="card-body">
                        <a href="{{ url('/eshopers/userAddress/create') }}" class="btn btn-success btn-sm" title="Add New userAddress"  style="float:right">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                     <!--    <form method="GET" action="{{ url('/eshopers/userAddress') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Address</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($useraddress as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td><b><p>{{ $item->address_1 }},<br>{{ $item->address_2 }}</p></b>
                                            <p>{{$item->city}}, {{$item->state}},</p>
                                            <p>{{$item->country}} - {{$item->zipcode}}</p>
                                       </td>
                                        <td>
                                            <a href="{{ url('/eshopers/userAddress/' . $item->id) }}" title="View userAddress"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/eshopers/userAddress/' . $item->id . '/edit') }}" title="Edit userAddress"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/eshopers/userAddress' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete userAddress" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $useraddress->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
