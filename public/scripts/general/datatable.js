'use strict'
var dataTableInit = function(){
    var options  = {
            stateSave: true,
            processing: true,
            serverSide: false,
            scrollX: true,
            "autoWidth": false,
            autoHeight : false,
            pageLength: 15,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            sDom: '<"dt-panelmenu clearfix"BTfr>t<"dt-panelfooter clearfix"ip>',
        };
    var tableInit = function(target,$args){
        console.log($args);
        var table = $('#dataTable').DataTable($args);
        table.on('page.dt', function () {
            countSelected();
        });

        return table;
    }

    return {
        init: function(target,args) {
            return tableInit(target,$.extend(true,options,args));
        }
    }
}();