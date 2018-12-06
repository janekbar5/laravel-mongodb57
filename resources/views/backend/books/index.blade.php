@extends('layouts.app-backend')


@section('content') 
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simple Tables
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
      </ol>
    </section>
    
    
    
    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 

    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('backend.books.create') }}"> Create New Book</a>
            </div>
        </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
      
        
        
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Role</th>
                  
                  <th>Acrion</th>
                </tr>
                @foreach ($books as $key=>$book)
            
	    <tr>
	        
                <td>
                   
                    @if ($book->imagesFront->count() > 0)
                        @foreach ($book->imagesFront as $image)			 
                            <img src="{{asset('gallery/images/thumbs_340/'.$image->file_name)}}" style="width:100px"/>
                        @endforeach 
                    @else
                            <img src="http://placehold.it/340x260" style="width:100px"/>
                    @endif
                                        
                </td>
	        <td>{{ $book->name }}</td>
	       
		<td>{{ $book->category()->first()->name }}</td>
                
                <td>
                    @foreach ($book->tags()->get() as $tag)
                    {{$tag->title}}
                    @endforeach  
                    
                    
                    
                   
                </td>
                
	        <td>
                   <form action="{{ route('backend.books.destroy',$book->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('backend.books.show',$book->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('backend.books.edit',$book->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td>
	    </tr>
	    @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
    {!! $books->render() !!}
    <!-- /.content -->
  </div>

  
   @include('backend.partial.footer')

   @include('backend.partial.rightsidebar')
  
  
<!-- jQuery 3 -->
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>





   
	
	
	
	
	


@endsection