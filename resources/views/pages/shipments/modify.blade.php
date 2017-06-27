@extends('templates.authenticated')

@section('curr-page')shipment-modify @stop

@section('content')
        <!-- Begin: Content -->
<?php
$customer = $data->getCustomer;
?>
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr" id="ShipmentSelector">

        <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Modify Shipment</span>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="customer" class="col-lg-2 control-label">Customer</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-user"></i>
                                    </span>
                                <input id="customer" class="form-control"
                                       value="{{ $customer ? $customer->name : 'Unknown' }}" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Products Panel -->
        <div class="panel panel-primary panel-border top lighter animated fadeIn">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Products</span>
            </div>
            <div class="panel-body" v-if="!submitted">
                <form action="#" class="form-horizontal" role="form" v-on="submit:addProduct($event)">
                    <div class="form-group">

                        <label for="name" class="col-lg-2 control-label">Product Code</label>

                        <div class="col-lg-8">
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-barcode"></i>
                                        </span>
                                <input id="code"
                                       class="form-control"
                                       name="code"
                                       placeholder="Barcode / Product Code E.g 12345678"
                                       autofocus
                                       v-model="productCode"
                                       v-el="barcodeInput"
                                        />
                            </div>
                        </div>
                        <div class="text-center col-lg-2">
                            <button type="submit" class="btn btn-success btn-rounded">
                                <span class="fa fa-plus mr10"></span>
                                <span id="btnText">Add Product</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="panel-footer">
                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr>
                        <th style="width:40%">Name</th>
                        <th style="width:20%">Code</th>
                        <th style="width:10%">Quantity</th>
                        <th style="width:10%">Available Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableData">
                    <tr v-repeat="products" v-transition="fade">

                        <td>@{{ name }}</td>
                        <td>@{{ code }}</td>
                        <td>@{{ quantity }}</td>
                        <td>@{{ available_quantity }}</td>
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

        $('.select2').select2();

        var vm = new Vue({
            el: '#ShipmentSelector',
            data: {

                products: [],
                productCode: '',

                submitted: false,
                processing: false,
            },
            ready: function () {
                this.fetch_products();
            },
            methods: {
                submit_form: function (e) {
                    e.preventDefault();

                    this.submitted = true;
                    this.processing = true;
                    $('#panelUser').hide();

                    var submit_button = $('#submitButton');
                    submit_button.html('<span class="fa fa-spinner fa-spin mr10"></span> <span id="btnText">Processing</span>');
                    // Validation
                    if (this.customer.create_customer) {
                        var data = this.customer;
                        if (data.name == "" || data.email == "") {
                            generalError('Customer Name and E-Mail is required!');
                            this.submitted = false;
                            $('#panelUser').show();
                            return;
                        } else {
                            vm.createCustomer();
                        }
                    } else if (this.customer.id = "") {
                        generalError('Customer is required!');
                        this.submitted = false;
                        $('#panelUser').show();
                        return;
                    } else if (!this.customer.create_customer && this.customer.id == "") {
                        this.customer.id = $('#select2').val();

                        vm.createShipment();
                    }

                    submit_button.html('<span class="fa fa-save mr10"></span><span id="btnText">Submit</span>');
                },

                fetch_products: function () {
                    this.$http.get('{{ route('modify-shipment-products',$data->id) }}', function (data) {
                        this.products = data;
                    })
                },

                addProduct: function (e) {
                    e.preventDefault();
                    var
                            code = this.productCode;

                    uri = '/api/products/search/' + code;
                    vm.$http.get(uri, function (data) {
                        if (data.type == 'error') {
                            generalError(data.message);
                        } else if (data.type = 'success') {
                            swal(
                                    {
                                        title: "Quantity<br><small>Available Quantity : " + data.quantity + "</small>",
                                        text: "Enter quantity for : " + data.name,
                                        type: "input",
                                        showCancelButton: true,
                                        closeOnConfirm: true,
                                        inputPlaceholder: "E.g 100",
                                        inputType: "integer",
                                        inputValue: 1,
                                        html: true,
                                    },
                                    function (inputValue) {
                                        if (inputValue === false) return false;
                                        if (inputValue === "") {
                                            swal.showInputError("Quantity required!");
                                            return false
                                        }
                                        var
                                                uri = '{{ route('shipment-store-product') }}',
                                                postData = {
                                                    code: data.code,
                                                    quantity: inputValue,
                                                    shipment_id: '{{ $data->id }}',
                                                };
                                        vm.$http.post(uri, postData, function (response) {
                                            if (response.result == 'success') {
                                                generalSuccess(response.message);
                                                vm.products.push({
                                                    id: response.id,
                                                    name: data.name,
                                                    code: data.code,
                                                    product_id: data.product_id,
                                                    quantity: inputValue,
                                                    available_quantity: response.quantity,
                                                });
                                            } else if (response.result == 'error') {
                                                generalError(response.message);
                                            }
                                        })

                                    }
                            );
                            playSuccess();
                        }
                    });
                    this.productCode = "";
                },

                deleteProduct: function (index) {
                    swal(
                            {
                                title: "Are you sure?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                closeOnConfirm: true
                            },
                            function () {
                                var product = vm.products[index];
                                vm.$http.get('/shipment/removeProduct/' + product.id, function (response) {
                                    if (response.result == "success") {
                                        generalSuccess(response.message)
                                        vm.products.splice(index, 1);
                                    } else if (response.result == "error") {
                                        generalError(response.message)
                                    }
                                });
                            }
                    );
                },
            }
        });
    </script>

@stop