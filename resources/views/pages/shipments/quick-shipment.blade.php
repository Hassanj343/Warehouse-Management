@extends('templates.authenticated')

@section('curr-page')shipment-quick @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr" id="ShipmentSelector">
        <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Quick Shipment</span>
            </div>
            <div class="panel-body">
                <div id="ajax-response"></div>
                <form action="#" id="ProductCode" v-on="submit: storeProducts($event)" class="form-horizontal">
                    
                    <div class="form-group">
                        <label for="name" class="col-lg-3 control-label">Product Code</label>

                        <div class="col-lg-9">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                </span>
                                <input id="code"
                                       class="form-control"
                                       name="code"
                                       placeholder="Product Name / Product Barcode"
                                       autofocus
                                       v-model="productCode"
                                       v-el="barcodeInput"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-rounded">
                            <span class="fa fa-plus mr10"></span>
                            <span id="btnText">Add Product</span>
                        </button>
                    </div>

                </form>
            </div>

        </div>

        <div class="panel panel-primary panel-border top lighter animated fadeIn">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Products Completed</span>
            </div>
            <div id="productsResponse" v-if="hasError">
                <div class="alert alert-danger m10">
                    @{{ alertMessages }}
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr>
                        <th style="width:60%">Name</th>
                        <th style="width:20%">Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableData">
                    <tr v-repeat="products">
                        <td>@{{ name }}</td>
                        <td>@{{ code }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" v-on="click: deleteProduct($index)">
                                <i class="imoon imoon-remove"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->

@stop

@section('custom-js')
    <script>
        var vm = new Vue({
            el: '#ShipmentSelector',
            data: {
                alertMessages: '',
                hasError: false,
                products: [],
                productCode: '',
            },

            ready: function () {
                this.$$.barcodeInput.focus();
            },
            methods: {

                storeProducts: function (e) {
                    e.preventDefault();
                    var
                            code = this.productCode,
                            uri = '/shipment/quick-sell?code=' + code;
                    this.$http.get(uri, function (data) {
                        if (data.type == 'error') {
                            generalError(data.message);
                        } else if (data.type == 'success') {
                            if (data.quantity <= 0) {
                                // generate error and play audio
                                generalError("Not enough quantity in stock");
                            } else {
                                // add to products list
                                this.products.push({
                                    'name': data.name,
                                    'code': data.code,
                                    'shipment_id': data.shipment_id,
                                });
                                this.products = remove_duplicates(this.products);
                                console.log(this.products);
                                playSuccess();
                            }
                        }
                    });
                    this.productCode = '';
                    this.$$.barcodeInput.focus();
                },

                deleteProduct: function (id) {
                    var
                            item = this.products[id],
                            uri = '{{ route('shipment-quick-remove') }}';
                    this.$http.post(uri, item, function (data) {
                        if (data.type == 'error') {
                            generalError(data.message);
                        } else if (data.type == 'success') {
                            this.products.splice(id, 1);
                            generalSuccess(data.message);
                        }
                    });

                    this.$$.barcodeInput.focus();
                }
            }
        });
    </script>

@stop