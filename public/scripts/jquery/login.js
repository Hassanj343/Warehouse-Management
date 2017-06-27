/*Login Ajax*/
$(document).ready(function() {
    $('#ajax-response').hide();
    $('#form-login').submit(function(e){
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var button = $('#form-login button[type=submit]');
        button.html(
            '<i class="fa fa-spinner fa-spin mr10"></i>' +
            'Signing In'
        );
        $('#form-login input').attr('disabled','disabled');
        $('#ajax-response').hide(500);
        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data)
                {
                    console.log(data.result);

                    if(data.result == 'error'){
                        console.log('error')
                        var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                            '<i class="fa fa-info pr10"></i>' +
                            '<strong>Error !</strong> ' + data.message +
                            '</div>';
                        $('#form-login input').prop('disabled',false);
                        button.html(
                            '<i class="fa fa-times mr10"></i>' +
                            'Error'
                        );
                        setTimeout(function(){button.html('SIGN IN'); }, 3000);
                        $('#ajax-response').html(html).show(500);
                    } else if(data.result == 'success'){
                        console.log('success')

                        var html = '<div class="alert alert-sm alert-border-left alert-success light alert-dismissable">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    '<i class="fa fa-info pr10"></i>' +
                                    '<strong>Success !</strong> ' + data.message +
                                    '</div>';
                        $('#ajax-response').html(html).show(500);
                        button.addClass( "success" ).html(
                            '<i class="fa fa-check mr10"></i>' +
                            'Success'
                        );
                        setTimeout(function(){ window.location = data.url; }, 3000);
                    }
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
        e.preventDefault(); //STOP default action
    });

});
