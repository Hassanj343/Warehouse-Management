function countSelected() {
    var bulk_btns = $('#buttons')
    var checkbox = $('#dataTable').find('input:checked');
    var total = checkbox.length;
    if (total <= 0) {
        bulk_btns.hide(300)
    } else {
        $('#bulkDelete .text').html("Delete " + total + " shipments")
        bulk_btns.show(300)
    }
}
$(document).ready(function () {
    dataTableInit.init("#dataTable",{
        ajax: options.dataTable.href,
        columns: [
            {data: 'select', name: 'select', searchable: true},
            {data: 'date', name: 'date', searchable: true},
            {data: 'customer', name: 'customer'},
            {data: 'created_by', name: 'created_by'},
            {data: 'products', name: 'products'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
    
    $('#buttons').hide(300);
    $('#bulkDelete').click(function (e) {
        e.preventDefault();
        var checkbox = $('#dataTable').find('input:checked');
        var total = checkbox.length;
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete '" + total + "' shipments . Warning data will be permanently deleted?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true,
            html : true,
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
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                            data.message +
                            '</div>';
                        $("#ajax-result").html(html);
                        $('#buttons').hide(300);
                        dataTable.ajax.reload();

                    } else if (data.result == 'error') {
                        var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                            data.message +
                            '</div>';
                        $("#ajax-result").html(html);
                    }

                }
            });
        });
    })
    //perform Delete
    $(document).on('click', 'a.deleteShipment', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "<span class='fg-red'>You will not be able to recover this shipment!</span>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: true,
            html : true,
        }, function () {
            $.get(href, function (data) {
                swal({
                    title : data.result.toUpperCase(),
                    text : data.message,
                    type : data.result,
                    html : true,
                })
                dataTable.ajax.reload();

            });
        });
    });
});