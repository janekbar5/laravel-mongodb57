@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tags.create') }}"> Create New Category</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($tags as $tag)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $tag->title }}</td>
	        <td>{{ $tag->description }}</td>
	        <td>
               
                
                <form action="{{ route('tags.destroy',$tag->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('tags.show',$tag->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('tags.edit',$tag->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


@endsection