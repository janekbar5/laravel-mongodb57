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

                    <form role="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden"  name="user_id" value="{{$user->id}}" >    


                        <div class="box-body">

                            

                            <div class="form-group">
                                <label for="inputAddress">Diaplayed Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="@if(!empty($user)){{ $user->name }}@endif" placeholder="Diaplayed name">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Assigned email</label>
                                <input type="text" class="form-control" id="email" name="email" value="@if(!empty($user)){{ $user->email }}@endif" placeholder="Assigned email">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Example block-level help text here.</p>
                            </div>



                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" name="roles[]" id="roles">
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}" @foreach($user->getRoleNames() as $p) @if($role->name == $p)selected="selected"@endif @endforeach>{{$role->name}}</option>
                                    @endforeach
                                </select>                
                            </div>

                            
                            

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

<!-- jQuery 3 -->
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>



<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!-- Page script -->
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
   
})

</script>

@stop

