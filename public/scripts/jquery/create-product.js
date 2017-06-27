$(document).ready(function() {
    $("#form-createProduct").submit(function(e){
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var button = $('#form-createProduct button[type=submit]');
        button.html(
            '<i class="fa fa-spinner fa-spin mr10"></i>' +
            'Processing'
        );
        $('#ajax-response').hide(500);
        $('#form-createProduct input').attr('disabled','disabled');
        $(this).addClass('loading')


        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                complete : function(){
                    $('#form-createProduct').removeClass('loading');
                    $('#form-createProduct input').prop('disabled',false);

                },
                success:function(data)
                {
                    console.log(data.result);

                },
                error: function(data)
                {
                    var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                        '<i class="fa fa-info pr10"></i>' +
                        '<strong>Error !</strong>' + ' An unknown error occurred. Please try again later' +
                        '</div>';
                    $('#form-login input').prop('disabled',false);
                    button.html(
                        '<i class="fa fa-times mr10"></i>' +
                        'Error'
                    );
                    setTimeout(function(){button.html('SIGN IN'); }, 3000);
                    $('#ajax-response').html(html).show(500);
                }
            });
        e.preventDefault();

    });
});