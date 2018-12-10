<script>
////////////////////////////////////////////Selct 2 Tags    
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
})
////////////////////////////////////////////CDD 
$('#make_id').change(function (e) {
    $.ajax
            ({
                url: '/model/getmodel',
                data: {make_id: $('#make_id').val(), "_token": "{{ csrf_token() }}"},
                type: 'post',
                success: function (data)
                {
                    $('#model_id').html(data);
                }
            });
});
//////////////////////////////////////////form
$('#submitForm').on('click', function () {
    var registerForm = $("#Register");
    var formData = registerForm.serialize();
    $('#title-error').html("");
    $('#description-error').html("");
    $('#make_id-error').html("");
    $('#model_id-error').html("");
    $.ajax({
        url: '/books/create_ajax',
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            if (data.errors) {
                if (data.errors.title) {
                    $('#title-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.title[0] + '</div>');
                }
                if (data.errors.description) {
                    $('#description-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.description[0] + '</div>');
                }
                if (data.errors.make_id) {
                    $('#make_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.make_id[0] + '</div>');
                }
                if (data.errors.model_id) {
                    $('#model_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.model_id[0] + '</div>');
                }
                if (data.errors.tags) {
                    $('#tags-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.tags[0] + '</div>');
                }
                 if (data.errors.tags) {
                    $('#category_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.category_id[0] + '</div>');
                }
            }
            if (data.success) {
                $(location).attr('href', '/books/edit_ajax/' + data.token);
            }
        },
    });
});


$('#submitForm2').on('click', function(){
        var registerForm = $("#Register");
        var formData = registerForm.serialize();
        $( '#title-error' ).html( "" );
        $( '#description-error' ).html( "" );
        $( '#make_id-error' ).html( "" );
        $( '#model_id-error' ).html( "" );

        $.ajax({
            url:'/books/store_ajax',
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
                 if (data.errors) {
                if (data.errors.title) {
                    $('#title-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.title[0] + '</div>');
                }
                if (data.errors.description) {
                    $('#description-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.description[0] + '</div>');
                }
                if (data.errors.make_id) {
                    $('#make_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.make_id[0] + '</div>');
                }
                if (data.errors.model_id) {
                    $('#model_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.model_id[0] + '</div>');
                }
                if (data.errors.tags) {
                    $('#tags-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.tags[0] + '</div>');
                }
                 if (data.errors.tags) {
                    $('#category_id-error').html('<div class="alert alert-danger alert-dismissible">' + data.errors.category_id[0] + '</div>');
                }
            }
                if(data.success) {
                    $(location).attr('href', '/books/index');                    
                }
            },
        });
    });
</script>