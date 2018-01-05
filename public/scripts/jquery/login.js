/*Login Ajax*/
$(document).ready(function() {
    $('#form-login').submit(function(e){
        var button = $('#form-login button[type=submit]');
        button.html(
            '<i class="fa fa-spinner fa-spin mr10"></i>' +
            'Signing In'
        );
        $('#form-login input').attr('disabled','disabled');
    });

});
