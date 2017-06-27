function countSelected() {
    var bulk_btns = $('#buttons')
    var checkbox = $('#dataTable').find('input:checked');
    var total = checkbox.length;
    if (total <= 0) {
        bulk_btns.hide(300)
    } else {
        $('#bulkDelete .text').html("Delete " + total + " Products")
        bulk_btns.show(300)
    }
}
$(document).ready(function () {
    dataTableInit.init("#dataTable",{
        ajax: options.dataTable.href,
        columns: [
            {data: 'select', name: 'select', searchable: true},
            {data: 'name', name: 'name', searchable: true},
            {data: 'price', name: 'price'},
            {data: 'type', name: 'type'},
            {data: 'quantity', name: 'stock'},
            {data: 'location', name: 'location'},
            {data: 'action', name: 'status', orderable: false, searchable: false}
        ],
    });
   
    $('#buttons').hide(300);
    $('#bulkDelete').click(function (e) {
        e.preventDefault();
        var checkbox = $('#dataTable').find('input:checked');
        var total = checkbox.length;
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete '" + total + "' products . Warning data will be permanently deleted?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true,
            html: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: options.bulkDelete.href,

                data: checkbox.serialize(),
                cache: false,
                success: function (data) {
                    console.log(data);
                    if (data.result = 'success') {
                        var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                            data.message +
                            '</div>';
                        $("#ajax-result").html(html);
                        $('#buttons').hide(300);
                        dataTable.ajax.reload();

                    } else if (data.result == 'error') {
                        var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                            data.message +
                            '</div>';
                        $("#ajax-result").html(html);
                    }

                }
            });
        });
    })
    //perform Delete
    $(document).on('click', 'a.deleteProduct', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete this product. Warning data will be permanently deleted?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true,
            html: true,
        }, function () {
            $.get(href, function (data) {
                if (data.result = 'success') {
                    var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                        data.message +
                        '</div>';
                    $("#ajax-result").html(html);
                    dataTable.ajax.reload();

                } else if (data.result == 'error') {
                    var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                        data.message +
                        '</div>';
                    $("#ajax-result").html(html);
                }
            });
        });

    });
});