@extends('templates.authenticated')

@section('curr-page')group-modify @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">
        <form class="form-horizontal" role="form" action="{{ route('post-modify-group',$data->id) }}" id="modifyGroup"
              method="post">
              {{ csrf_field() }}
            <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
                <div class="panel-heading">
                    <span class="panel-title" id="panel-title">Modify Group</span>
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
                                       placeholder="Group Name"
                                       value="{{ $data['name'] }}"/>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <label class="col-md-12" for="dataTable">Add Product</label>

                        <div class="col-md-12">
                            <select name="product" class="form-control" style="width: 100%" id="select2">
                                <option value="" selected> Select a product</option>
                                @foreach(\App\Models\Product::all() as $key => $product)
                                    @if($product->group_id != $data->id && !($product->group_id == 0 or is_null($product->group_id) ))
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <a class="btn btn-success" href="#" id="addProduct">
                                <i class="fa fa-plus-square"></i>
                                Add Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary panel-border top lighter animated slideInDown">
                <div class="panel-heading">
                    <span class="panel-title" id="panel-title">Products</span>
                </div>
                <div id="productsResponse"></div>
                <div class="panel-body">
                    <table class="table table-hover" id="dataTables">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tableData">
                        </tbody>
                    </table>
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
        dataTableInit.init("#dataTable",{
                ajax: '{{ route('api-list-group-products',$data->id) }}',
                columns: [
                    {data: 'name', name: 'name', searchable: true, orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        function click_product(href) {
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to remove this product from group?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: true,
                html : true,
            }, function () {
                $.get(href, function (data) {
                    if (data.result = 'success') {
                        var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>' +
                                data.message +
                                '</div>';
                        $("#productsResponse").html(html);
                        $('#productsResponse').show(300)
                        setTimeout(function () {
                            $('#productsResponse').hide(300)
                            $("#productsResponse").html("");
                        }, 3000)
                        table.ajax.reload();

                    } else if (data.result == 'error') {
                        var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>' +
                                data.message +
                                '</div>';
                        $("#productsResponse").html(html);
                        setTimeout(function () {
                            $('#productsResponse').hide(300)
                            $("#productsResponse").html("");
                        }, 3000)
                    }

                });
            });
        }
        $(document).ready(function () {
            $('#modifyGroup').AjaxForm();
            $('#select2').select2();

            $('.updateTable').click(function (e) {
                table.ajax.reload();

            })


            $('#addProduct').click(function (e) {
                e.preventDefault();
                var selected = $('#select2').find(':selected');
                var href = '{{ URL::to('group/add/product') }}' + '/{{ $data->id }}/' + selected.val();

                $.get(href, function (data) {
                    if (data.result = 'success') {
                        var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>' +
                                data.message +
                                '</div>';
                        // Remove selected item
                        selected.remove();
                        $('#select2').select2("val", "");

                        $("#productsResponse").html(html);
                        $('#productsResponse').show(300);
                        table.ajax.reload();
                        setTimeout(function () {
                            $('#productsResponse').hide(300)
                            $("#productsResponse").html("");
                        }, 3000)


                    } else if (data.result == 'error') {
                        var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>' +
                                data.message +
                                '</div>';
                        $("#productsResponse").html(html);
                        setTimeout(function () {
                            $('#productsResponse').hide(300)
                            $("#productsResponse").html("");
                        }, 3000)
                    }

                });

            })


        });
    </script>

@stop