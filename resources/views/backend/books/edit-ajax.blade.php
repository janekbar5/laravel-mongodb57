@extends('layouts.app-backend')




@section('content')
<!--////////////////////////////////image /////////////////////////-->		
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}"> 




    <style>
        .delete-img{
            width:30px;
            position:absolute;
            top:0px;
            left:70px;

            cursor:pointer;
            z-index: 1000;
        }
        #gallery-images ul li {
            position:relative;
            list-style:none;
            width:auto;
            float:left;
            border:solid 1px red;
        }

        #gallery-images ul li a img{
            float:left;
            width:100px;
        }

        #gallery-images ul li a:hover{
            cursor: move;
        }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    

<script>

var baseUrl = "{{url('/')}}";


Dropzone.options.addImages = {

    maxFilesize: 2000,
    maxFiles: 5,
    acceptedFiles: 'image/*,.jpeg,.jpg',
    success: function (file, response) {
        if (file.status == 'success') {
            handleDropzoneFileUpload.handleSuccess(response);
        } else {
            handleDropzoneFileError.handleSuccess(response);
        }
    }
};





var handleDropzoneFileUpload = {
    handleError: function (response) {
        //console.log(response);
        alert('error');
    },
    handleSuccess: function (response) {
        //alert('sucsess');
        //location.reload();

        var imageList = $('#gallery-images ul');
        var imageList = $('#gallery-images ul').addClass('ui-sortable');
        var imageSrc = baseUrl + '/gallery/images/thumbs_240/' + response.file_name;
        var imageId = response._id;
        $(imageList).append('<li id="' + imageId + '" class="ui-sortable-handle">\n\
                                <a href="' + imageSrc + '"><img src="' + imageSrc + '"></a><br>\n\
                                <button class="btn" data-value="' + imageId + '">DELETE</button>\n\
                                </li>');
    }
}

$(document).ready(function () {
    //console.log('Document is ready');
});



////////////////////////////////////////////////////////////DELETE IMG
$('.btn').click(function (e) {
    var image_id = $(this).data("value");
    $.ajax
            ({
                url: '/images/deleteimg/' + image_id,
                data: {"image_id": image_id},
                type: 'get',
                success: function (result)
                {
                    //alert('done')
                    $('#' + image_id).remove();
                }
            });
});
////////////////////////////////////////////////////////////ORDER
$(document).ready(function () {

    function slideout() {
        setTimeout(function () {
            $("#response").slideUp("slow", function () {
            });

        }, 2000);
    }

    $("#response").hide();
    $(function () {
        $("#gallery-images ul").sortable({opacity: 0.8, cursor: 'move', update: function () {
                var token = $("#token").val();
                var order = '' + $(this).sortable("toArray");
                $.ajax({
                    url: '/images/changeImageOrder',
                    type: 'post',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", order},
                    success: function (data) {
                        //console.log(data);
                        //alert(data);
                    }, error: function () {
                        //alert("error!!!!");
                        //console.log(data);
                    }
                })
            }
        });
    });

});

    </script>	
    
    
    
    

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

    
    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 

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


                    <div class="col-md-12">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="gallery-images">
                                    <div id="response"> </div>
                                    <ul class="ui-sortable">
                                        @foreach($book->imagesBack as $image)
                                        <li id="{{ $image->id }}" class="ui-sortable-handle">
                                            <a href="{{ url($image->file_path) }}" >
                                                <img src="{{ url('/gallery/images/thumbs_240/' . $image->file_name) }}" width="100"/>
                                            </a><br>
                                            <button class="btn" data-value="{{ $image->id }}">DELETE</button>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <form class="dropzone" id="addImages" action="{{url('books/do-upload')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="book_id" value="{{ $book->id }}" />
                                    <div class="dz-message" data-dz-message><span>Click here, or drag and drop to upload images</span></div>
                                </form>

                            </div>
                        </div>
                        <br><br>
                    </div>

                    <!--<form role="form" method="POST" action="{{ route('backend.books.update',$book->id) }}" enctype="multipart/form-data">-->
                        <form method="POST" id="Register" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $book->id }}" class="form-control" >
                        {{ csrf_field() }}



                        <div class="box-body">



                            <div class="form-group">
                                <strong>Name:</strong>
                                
                                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" placeholder="Diaplayed name">
                                 <span class="text-danger"><strong id="title-error"></strong></span>
                            </div>



                            <div class="form-group">
                                <strong>Description:</strong>
                               <textarea class="form-control" style="height:150px" id="description" name="description" placeholder="Description">{{ $book->description }}</textarea>
                                <span class="text-danger"><strong id="description-error"></strong></span>
                            </div>

                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" name="tags[]" id="tags">
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" @foreach($book->tags()->get() as $p) @if($tag->id == $p->id)selected="selected"@endif @endforeach>{{$tag->title}}</option>
                                    @endforeach
                                </select>                
                            </div>

                            
                            
                            
                            <div class="form-group">
                                <label for="City">Choose Make</label>
                                <select name="make_id" id="make_id" class="form-control">

                                    @if (isset($makes))
                                    <option value ="">Choose Make</option>  
                                    @foreach ($makes as $make)
                                    <option value ="{{$make->id}}" @if ($make->id === $book->make_id) selected="selected" @endif>{{ $make->title }} </option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="text-danger"><strong id="make_id-error"></strong></span>
                            </div> 
                            
                            
                            
                            
                            
                        @if (isset($models))
                        <div class="form-group">
                        <label for="City">Choose Model</label>
                        <select name="model_id" id="model_id" class="form-control">  
                          <option value ="">Choose Model</option>  
                            @foreach ($models as $model)
                            <option value ="{{$model->id}}" @if ($model->id === $book->model_id) selected="selected" @endif>{{ $model->title }} </option>                             
                            @endforeach
                         </select>
                        
                        <span class="text-danger"><strong id="model_id-error"></strong></span>
                      </div>     
                        @else
                         <div class="form-group" id="model_id">
                             
                             <span class="text-danger"><strong id="model_id-error"></strong></span>
                         </div>    
                        @endif
		
						
                        
		      
                           


                           <div class="form-group">
                        <label for="City">Choose Category</label>
                        <select name="category_id" class="form-control">

                            @if (isset($categories))
                            <option value ="">Choose Category</option>  
                            @foreach ($categories as $cat)
                            <option value ="{{$cat->id}}" @if ($cat->id === $book->category_id) selected="selected" @endif>{{ $cat->name }} </option>

                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger"><strong id="category_id-error"></strong></span>
                    </div>  


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Save</button>
                            <button type="button" id="submitForm2" class="btn btn-primary btn-prime white btn-flat">Save & Close</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->




            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </section>


        
@include('backend.partial.footer')
@include('backend.partial.rightsidebar')

<!-- jQuery 3 -->
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!--
<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
-->

@include('backend.partial.formjavascripts')

    
@endsection