@extends('templates.authenticated')

@section('curr-page')group-create @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">
        <form class="form-horizontal" role="form" action="{{ route('post-create-group') }}" id="createGroup"
              method="post">
              {{ csrf_field() }}
            <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
                <div class="panel-heading">
                    <span class="panel-title" id="panel-title">Create Group</span>
                </div>
                <div class="panel-body">
                    <div id="ajax-response"></div>
                    <div class="form-group">
                        <label for="name" class="col-md-12">Group Name</label>

                        <div class="col-md-12">
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tags"></i>
                                        </span>
                                <input autocomplete="off"
                                       id="name"
                                       class="form-control"
                                       name="name"
                                       placeholder="Group Name"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Save Button -->
            <div class="text-center col-md-12">
                <button type="submit" class="btn btn-lg btn-success">
                    <span class="fa fa-save mr10"></span>
                    <span id="btnText">Submit</span>
                </button>
            </div>
        </form>

    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->

@stop

@section('custom-js')
    <script src="{{ asset('scripts/general/general-datatable.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('assets/admin-tools/admin-forms/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/admin-tools/admin-forms/js/additional-methods.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/plugins/jquerymask/jquery.maskedinput.min.js') }}"></script>
    <script>
        function click_tab(e) {
            $(e).trigger('click');
        }
        $(document).ready(function () {
            $('#createGroup').AjaxForm();
            $('#dataTables').dataTable();
            $('#select2').select2();


        });
    </script>

@stop