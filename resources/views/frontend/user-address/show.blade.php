@extends('frontend.layouts.frontapp')

@section('middleSection')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">userAddress {{ $useraddress->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/eshopers/userAddress') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/eshopers/userAddress/' . $useraddress->id . '/edit') }}" title="Edit userAddress"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('eshopers/userAddress' . '/' . $useraddress->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete userAddress" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $useraddress->id }}</td>
                                    </tr>
                                    <tr><th> Address 1 </th><td> {{ $useraddress->address_1 }} </td></tr><tr><th> Address 2 </th><td> {{ $useraddress->address_2 }} </td></tr><tr><th> City </th><td> {{ $useraddress->city }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
