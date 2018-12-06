<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<script>

var baseUrl = "{{url('/')}}";


Dropzone.options.addImages={
	
	maxFilesize:200,
	maxFiles: 5,
	acceptedFiles:'image/*,.jpeg,.jpg',
		success: function(file, response){
			if(file.status=='success'){
			handleDropzoneFileUpload.handleSuccess(response);
			}else{
			handleDropzoneFileError.handleSuccess(response);
			}
		}
};



		
		
var handleDropzoneFileUpload = {
	handleError:function(response){
	//console.log(response);
	alert('error');
	},
	handleSuccess:function(response){
	//alert('sucsess');
	//location.reload();
	
	var imageList = $('#gallery-images ul');
	var imageList = $('#gallery-images ul').addClass('ui-sortable');
	var imageSrc =  baseUrl + '/gallery/images/thumbs_240/' + response.file_name;
	var imageId =  response.id;
	$(imageList).append('<li id="' + imageId + '" class="ui-sortable-handle"><img class="delete-img" src="/img/red-delete-button.png" onclick="deleteArticle('+imageId+')"/><a href="' + imageSrc + '"><img src="' + imageSrc + '"></a></li>');
	}
}

$(document).ready(function(){
//console.log('Document is ready');
});



////////////////////////////////////////////////////////////DELETE
function deleteArticle(id) {
 $.ajax({
 url: '/images/deleteimg/'+id,
 type: 'post',
 data: { "_token": "{{ csrf_token() }}" }, 
 success: function(result) {
 console.log(result);
 //alert('success');
 //location.reload();
 
$("#gallery-images").load(location.href + " #gallery-images");
}
});
}
////////////////////////////////////////////////////////////ORDER
$(document).ready(function(){ 	

function slideout(){
setTimeout(function(){
$("#response").slideUp("slow", function () {
});
    
}, 2000);}
	
    $("#response").hide();
	$(function() {
	$("#gallery-images ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			var token = $("#token").val();						
			var order = ''+$(this).sortable("toArray");	
			
			
			    	$.ajax({
					url:'/images/changeImageOrder',
					type:'POST',			        
					dataType:'json',
					data:{"_token": "{{ csrf_token() }}", order },
					success:function(data){
						//console.log(data);
				        //alert(data);
				    },error:function(){ 
				        //alert("error!!!!");
				    	//console.log(data);
				    }
				})														 
		}								  
		});
	});

});	

</script>	