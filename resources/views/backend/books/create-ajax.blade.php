@extends('layouts.app-backend')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advanced Form Elements
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
        </ol>
    </section>





    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                   <!-- <form role="form" method="POST" action="{{ route('backend.books.store') }}" enctype="multipart/form-data">-->
                        <form method="POST" id="Register">
                       
                        {{ csrf_field() }}



                        <div class="box-body">



                            <div class="form-group">
                                <label for="inputAddress">title</label>
                                <input type="text" class="form-control" id="title" name="title" value="" placeholder="Diaplayed name">
                                
                                <span class="text-danger"><strong id="title-error"></strong></span>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Description</label>
                                <textarea class="form-control" style="height:150px" id="description" name="description" placeholder="Detail"></textarea>
                                <span class="text-danger"><strong id="description-error"></strong></span>
                            </div>



                            

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select class="form-control select2" multiple="multiple" name="tags[]" id="tags">
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" >{{$tag->title}}</option>
                                    @endforeach
                                </select>  
                                 <span class="text-danger"><strong id="tags-error"></strong></span>
                            </div>


                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    <option value ="">Choose Category</option>                
                                    @if (isset($categories))
                                    @foreach ($categories as $cat)
                                    <option value ="{{$cat->id}}">{{ $cat->name }} </option>
                                    @endforeach
                                    @endif
                                </select>
                                
                                 <span class="text-danger"><strong id="category_id-error"></strong></span>
                            </div>


                            <div class="form-group">
                                <label for="City">Choose Make</label>
                                <select name="make_id" id="make_id" class="form-control">
                                    <option value ="">Choose Make</option>  
                                    @foreach ($makes as $make)
                                    <option value ="{{$make->id}}" >{{ $make->title }} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="make_id-error"></strong>
                                </span>
                            </div> 
                            
                             <div class="form-group">
                            <label for="City">Choose Model</label>
                            <select name="model_id" id="model_id" class="form-control">  
                                <option value ="">Choose Make</option>  

                            </select>
                            <span class="text-danger">
                                <strong id="model_id-error"></strong>
                            </span>
                        </div> 




                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             <button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->




            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </section>



</div>
<!-- /.content-wrapper -->


@include('backend.partial.footer')

@include('backend.partial.rightsidebar')


<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>



<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->

@include('backend.partial.formjavascripts')



@endsection