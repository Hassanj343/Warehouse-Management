@extends('templates.authenticated')

@section('curr-page')products-create @stop

@section('content')

        <?php
                $warning_1 = \HelperFunctions::getSettings('warning-level-1');
                $warning_2 = \HelperFunctions::getSettings('warning-level-2');
                $warning_3 = \HelperFunctions::getSettings('warning-level-3');
                ?>
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">

        <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Create Product</span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="{{ route('post-create-product') }}" id="createProduct"
                      method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="ajax-response"></div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="product_name" class="col-md-12">Product Name</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="product_name"
                                           class="form-control"
                                           name="product_name"
                                           placeholder="Product Name"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_quantity" class="col-md-12">Product Quantity</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-stackoverflow"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="product_quantity"
                                           class="form-control"
                                           name="product_quantity"
                                           placeholder="Product Quantity"
                                           type="number"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="purchase_price" class="col-md-12">Purchase Price</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon">£</i>
                                    </span>
                                    <input autocomplete="off"
                                           id="purchase_price"
                                           class="form-control"
                                           name="purchase_price"
                                           placeholder="Purchase Price"
                                           type="text"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sale_price" class="col-md-12">Sale Price</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon">£</i>
                                    </span>
                                    <input autocomplete="off"
                                           id="sale_price"
                                           class="form-control"
                                           name="sale_price"
                                           placeholder="Sale Price"
                                           type="text"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode" class="col-md-12">Barcode</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-barcode"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="barcode"
                                           class="form-control"
                                           name="barcode"
                                           placeholder="Barcode"
                                           type="text"/>
                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="supplier" class="col-md-12">Supplier</label>

                            <div class="col-md-12">
                                <div class="">
                                    <select name="supplier" class="form-control" id="supplier" tabindex="4">
                                        <option value="" selected>Select Supplier</option>
                                        @foreach(\App\Models\Supplier::all() as $key => $supplier)
                                            <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="location" class="col-md-12">Location</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="location"
                                           class="form-control"
                                           name="location"
                                           placeholder="Location"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="warning_1" class="col-md-12">Stock Alert Level 1</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="warning_1"
                                           class="form-control"
                                           name="warning_1"
                                           placeholder="Stock Alert Level 1"
                                           type="text"
                                           value="{{ $warning_1 }}"/>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="warning_2" class="col-md-12">Stock Alert Level 2</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="warning_2"
                                           class="form-control"
                                           name="warning_2"
                                           placeholder="Stock Alert Level 2"
                                           type="text"
                                           value="{{ $warning_2 }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="warning_3" class="col-md-12">Stock Alert Level 3</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="warning_3"
                                           class="form-control"
                                           name="warning_3"
                                           placeholder="Stock Alert Level 3"
                                           type="text"
                                           value="{{ $warning_3 }}"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="product_type" class="col-md-12">Product Type</label>

                            <div class="col-md-12">
                                <div class="">
                                    <select name="product_type" class="form-control" id="product_type" tabindex="4">
                                        @foreach(config('app_config.product_type') as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="group" class="col-md-12">Group</label>

                            <div class="col-md-12">
                                <div class="">
                                    <select name="group" class="form-control" id="group" tabindex="4">
                                        <option value="" selected>Select Group</option>
                                        @foreach(\App\Models\Group::all() as $key => $group)
                                            <option value="{{ $group->id }}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    
                    <!-- Description -->
                    <div class="col-lg-12">
                        <hr class="short alt"/>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class="">
                                <textarea autocomplete="off"
                                    id="description"
                                    class="form-control"
                                    name="description"
                                    placeholder="Description"
                                    rows="8" cols="20"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="col-lg-12">
                        <hr class="short alt"/>
                        <div class="form-group">
                            <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                                <div class="row">
                                    <div class="col-md-12 mb10">
                                        <div class="col-md-7">
                                            <label for="image-file">Image</label>
                                        </div>
                                        <div class="col-md-5">
                                            <span class="button btn-system btn-file btn-block">
                                                <span class="fileupload-new">Select</span>
                                                <span class="fileupload-exists">Change</span>
                                            <input type="file" name="image" id="image-file">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="fileupload-preview thumbnail mb20">
                                        <img data-src="holder.js/100%x140" alt="holder" style="max-height:200px;">
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
        </div>

    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->

@stop

@section('custom-js')

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
            $('#supplier').select2();
            $('#group').select2();
            $("#sale_price").spinner({
                step: 0.01,
                numberFormat: "n"
            });
            $("#purchase_price").spinner({
                step: 0.01,
                numberFormat: "n"
            });
            $('#purchase_price').focusout(function () {
                var sale_price = $("#sale_price");
                if (parseFloat(sale_price.val()) <= parseFloat($(this).val())) {
                    sale_price.val(($(this).val() * 1.0).toFixed(2));
                    $(this).val(($(this).val() * 1.0).toFixed(2));
                }
            });
            $('#sale_price').focusout(function () {
                var price = $('#purchase_price').val();
                ;
                var sprice = $(this).val();
                if (parseFloat(price) >= parseFloat(sprice)) {
                    $('#sale_price').val(price).toFixed(2);
                    $('#purchase_price').val(price).toFixed(2);
                }
            });

        });
    </script>

@stop

@section('custom-js-2')
<script type="text/javascript" src="{{ asset('vendor/plugins/fileupload/fileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap/holder.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        // grant file-upload preview onclick functionality
            $('.fileupload-preview').on('click', function() {
                $('.btn-file > input').click();
            });
    });
</script>
@endsection