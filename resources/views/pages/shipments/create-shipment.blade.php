@extends('templates.authenticated')

@section('curr-page')shipment-create @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr" id="ShipmentSelector">

        <div id="productsResponse" v-if="submitted && products.length ==0">
            <div class="alert alert-info m10">
                Shipment Created. <a href="{{ route('manage-shipments') }}" class="fg-hover-gray fg-white">Click here to return back to shipments</a>.
            </div>
        </div>

        <div class="screenOverlay" v-if="processing">
            <div class="spinner">
                <div class="spinner-loader">
                    Loading…
                </div>
                <div class="text">Processing ...</div>

            </div>
        </div>

        <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Create Shipment</span>
            </div>
            <div class="panel-body">
                <div id="ajax-response"></div>

                <div class="form-horizontal">
                    <div class="form-group">
                    <label for="customer-type" class="control-label col-lg-3">Customer Type:</label>

                        <div class="col-lg-9">
                            <select id="customer-type" class="form-control select2">
                                <option value="existing-customer" selected> Existing Customer</option>
                                <option value="new-customer">New Customer</option>
                            </select>
                        </div>
                    </div>
                </div>

                <form action="#" method="post" id="Shipment" v-el="shipmentForm" class="form-horizontal">
    {{ csrf_field() }}
                    
                    <div class="form-group" id="existing-customer">
                        <label for="group" class="col-lg-3 control-label">Customer</label>

                        <div class="col-lg-9">
                            <select name="customer" required class="form-control select2" id="select2" tabindex="4"
                                    v-model="customer.id">
                                <option value="" selected>Select Customer</option>
                                @foreach(\App\Models\Customer::all() as $key => $customer)
                                    <option value="{{ $customer->id }}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="create-customer" id="create-customer">
                        <div class="col-lg-6">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="col-lg-3 control-label">Customer Name</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="name"
                                               class="form-control"
                                               name="name"
                                               placeholder="Customer Name"
                                               v-model="customer.name"/>
                                    </div>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address" class="col-lg-3 control-label">Address</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-stackoverflow"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="address"
                                               class="form-control"
                                               name="address"
                                               placeholder="E.g: 123 Sample Road"
                                               type="text"
                                               v-model="customer.address"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile" class="col-lg-3 control-label">Mobile</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-mobile"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="mobile"
                                               class="form-control"
                                               name="mobile"
                                               placeholder="E.g. 01234567890"
                                               type="text"
                                               v-model="customer.mobile"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-lg-3 control-label">E-Mail</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-envelop"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="email"
                                               class="form-control"
                                               name="email"
                                               placeholder="E-Mail"
                                               type="email"
                                               v-model="customer.email"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="city" class="col-lg-3 control-label">City</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="city"
                                               class="form-control"
                                               name="city"
                                               placeholder="City"
                                               v-model="customer.city"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country" class="col-lg-3 control-label">Country</label>

                                <div class="col-lg-9">
                                    <div class="">
                                        <select name="country" class="form-control" id="country" tabindex="4"
                                                v-model="customer.country">
                                            <option value="" selected>Select Country</option>
                                            @foreach(\HelperFunctions::get_currency_list() as $key => $country)
                                                <option value="{{ $key }}">{{$country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telephone" class="col-lg-3 control-label">Telephone</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="imoon imoon-phone"></i>
                                    </span>
                                        <input autocomplete="off"
                                               id="telephone"
                                               class="form-control"
                                               name="telephone"
                                               placeholder="E.g. 01234567890"
                                               type="text"
                                               v-model="customer.phone"/>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </form>
            </div>

        </div>

        <div class="panel panel-success darker animated fadeIn" v-if="submitted">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Completed Products</span>

            </div>
            <div class="panel-body">
                <table class="table table-hover" id="dataTables">
                    <thead>
                    <tr>
                        <th style="width:40%">Name</th>
                        <th style="width:20%">Code</th>
                        <th style="width:10%">Quantity Removed</th>
                        <th style="width:10%">Quantity Left</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableData">
                    <tr v-repeat="completedProducts" v-transition="fade">
                        <td>
                            @{{ name }}
                        </td>
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

        <!-- Errors Panel -->
        <div class="panel panel-danger darker animated fadeIn" v-if="submitted && errorProducts.length >= 1">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Errors</span>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody v-repeat="errorProducts" v-transition="fade">
                    <tr>
                        <td>@{{ name }}</td>
                        <td>@{{ code }}</td>
                        <td>@{{ message }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Products Panel -->
        <div class="panel panel-primary panel-border top lighter animated fadeIn" v-if="!submitted">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Products</span>
            </div>
            <div class="panel-body" v-if="!submitted">
                <form action="#" class="form-horizontal" role="form" v-on="submit:addProduct($event)">
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

        <!-- Save Button -->
        <div class="text-center col-md-12" v-if="!submitted">
            <button type="submit" class="btn btn-lg btn-success" v-on="click:submit_form($event)" id="submitButton">
                <span class="fa fa-save mr10"></span>
                <span id="btnText">Submit</span>
            </button>
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
                alertMessages: '',
                hasError: false,
                products: [],
                completedProducts: [],
                errorProducts: [],
                productCode: '',
                customer: {
                    create_customer: false,
                    id: "",
                    country: "",
                    phone: "",
                    email: "",
                    mobile: "",
                    address: "",
                    name: "",
                    city: "",
                },
                shipment_id: 0,
                submitted: false,
                uri_createShipment: '{{ route('shipment-create-shipment') }}',
                uri_createShipmentProduct: '{{ route('shipment-store-product') }}',
                processing:false,
            },
            ready: function () {
                var customer_type = $('#customer-type');
                this.changeCustomerType(customer_type.val());
                customer_type.on('change', function () {
                    vm.changeCustomerType(customer_type.val());
                })
            },
            methods: {
                changeCustomerType: function (type) {
                    if (type == 'new-customer') {
                        this.customer.create_customer = true;
                        $('#create-customer').show();
                        $('#existing-customer').hide();

                    } else if (type == 'existing-customer') {
                        this.customer.create_customer = false;
                        $('#create-customer').hide();
                        $('#existing-customer').show();
                    }
                },


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

                createCustomer: function () {
                    var data = this.customer;
                    this.$http.post('{{ route('post-create-customer') }}', data, function (result) {
                        if (result.result == 'error') {
                            generalError(result.message);
                        } else if (result.result == "success") {
                            this.customer.id = result.id;
                            vm.createShipment();
                        }
                    });
                },
                createShipment: function () {
                    this.$http.post(this.uri_createShipment, {customer_id: vm.customer.id}, function (result) {
                        if (result.result == 'error') {
                            generalError(result.message);
                        } else if (result.result == 'success') {
                            vm.shipment_id = result.shipment_id;
                            vm.storeShipmentProducts()
                        }

                    });

                },
                storeShipmentProducts: function () {

                    var total = this.products.length;
                    for (var i = 0; i < total; i++) {
                        var data = {
                            shipment_id: vm.shipment_id,
                            code: vm.products[i].code,
                            quantity: vm.products[i].quantity,
                        };
                        var product = vm.products[i];
                        var success = false;
                        this.products.splice(i,1);
                        this.$http.post(this.uri_createShipmentProduct, data, function (result) {
                            if (result.result == 'error') {

                                vm.errorProducts.push({
                                    name : product.name,
                                    code : product.code,
                                    message : result.message,
                                });

                            } else if (result.result == 'success') {
                                console.log(product);
                                success = true;

                                var data = {
                                    name: product.name,
                                    code: product.code,
                                    quantity: product.quantity,
                                    available_quantity: result.quantity_left
                                }
                                vm.completedProducts.push(data);
                                playSuccess();
                                if(i == total){
                                    vm.processing = false;
                                }
                            }
                        });
                    }

                },

                addProduct: function (e) {
                    e.preventDefault();
                    var
                            code = this.productCode,
                            avail_qauntity = 0;
                    uri = '/api/products/search-product?code=' + code;
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
                                        animation: "slide-from-top",
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
                                        vm.products.push({
                                            name: data.name,
                                            code: data.code,
                                            product_id: data.product_id,
                                            quantity: inputValue,
                                            available_quantity: data.quantity,
                                        });
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
                                vm.products.splice(index, 1);
                                playSuccess();
                            }
                    );
                },

            }
        });
    </script>

@stop