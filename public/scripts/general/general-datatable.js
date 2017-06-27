var generalTable = function(){
    var abc_filtering = function(target){
        // ABC FILTERING
        var table6 = $('#' + target).DataTable({
            "sDom": 't<"dt-panelfooter clearfix"ip>',
            "ordering": false,
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [-1]
            }],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            },
            "iDisplayLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        });

        var alphabet = $('<div class="dt-abc-filter"/>').append('<span class="abc-label">Search: </span> ');
        var columnData = table6.column(0).data();
        var bins = bin(columnData);

        $('<span class="active"/>')
            .data('letter', '')
            .data('match-count', columnData.length)
            .html('None')
            .appendTo(alphabet);

        for (var i = 0; i < 26; i++) {
            var letter = String.fromCharCode(65 + i);

            $('<span/>')
                .data('letter', letter)
                .data('match-count', bins[letter] || 0)
                .addClass(!bins[letter] ? 'empty' : '')
                .html(letter)
                .appendTo(alphabet);
        }

        $('#' + target).parents('.panel').find('.panel-menu').addClass('dark').html(alphabet);

        alphabet.on('click', 'span', function() {
            alphabet.find('.active').removeClass('active');
            $(this).addClass('active');

            _alphabetSearch = $(this).data('letter');
            table6.draw();
        });

        var info = $('<div class="alphabetInfo"></div>')
            .appendTo(alphabet);

        var _alphabetSearch = '';

        $.fn.dataTable.ext.search.push(function(settings, searchData) {
            if (!_alphabetSearch) {
                return true;
            }
            if (searchData[0].charAt(0) === _alphabetSearch) {
                return true;
            }
            return false;
        });

        function bin(data) {
            var letter, bins = {};
            for (var i = 0, ien = data.length; i < ien; i++) {
                letter = data[i].charAt(0).toUpperCase();

                if (bins[letter]) {
                    bins[letter] ++;
                } else {
                    bins[letter] = 1;
                }
            }
            return bins;
        }
    }

    var datatools = function(target){
        $('#'+ target).dataTable({
            stateSave: true,
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [-1]
            }],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            },
            "iDisplayLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        });
    }

    return {
        init: function(target) {
            //abc_filtering(target);
            datatools(target);
        }
    }
}();