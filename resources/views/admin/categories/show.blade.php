@extends('admin.dashboard.index')
@section('contentHeader')
      <h1>
        Categories
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/categories"><i class="fa fa-dashboard"></i>Categories</a></li>
        <li class="active">Update {{ $category->id }}</li>
      </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">category {{ $category->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/categories/' . $category->id . '/edit') }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/categories' . '/' . $category->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $category->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $category->name }} </td></tr><tr><th> Parent Category </th><td> {{ App\Category::find($category->parent_id)->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
