<script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/general/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/general/datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery-confirm-master/dist/jquery-confirm.min.js') }}"></script>

<script type="text/javascript">
    var options = {
        dataTable: {
            swfPath: '{{ asset('vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}'
        }
    }

    jQuery(document).ready(function () {
        "use strict";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Init javascript core
        Core.init();

    });
</script>
<!-- END: PAGE SCRIPTS -->
@yield('custom-js')