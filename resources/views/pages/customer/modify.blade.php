@extends('templates.authenticated')

@section('curr-page')customer-create @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">

        <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Update Customer</span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="{{ route('post-modify-customer',$data->id) }}"
                      id="createCustomer"
                      method="post">
                    {{ csrf_field() }}
                    <div id="ajax-response"></div>
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-md-12">Customer Name</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="name"
                                           class="form-control"
                                           name="name"
                                           placeholder="Customer Name"
                                           value="{{ $data->name }}"/>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="address" class="col-md-12">Address</label>

                            <div class="col-md-12">
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
                                           value="{{ $data->address }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-md-12">Mobile</label>

                            <div class="col-md-12">
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
                                           value="{{ $data->mobile }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-12">E-Mail</label>

                            <div class="col-md-12">
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
                                           value="{{ $data->email }}"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="city" class="col-md-12">City</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input autocomplete="off"
                                           id="city"
                                           class="form-control"
                                           name="city"
                                           placeholder="City"
                                           value="{{ $data->city }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country" class="col-md-12">Country</label>

                            <div class="col-md-12">
                                <div class="">
                                    <select name="country" class="form-control" id="country" tabindex="4">
                                        <option value="">Select Country</option>
                                        @foreach(\HelperFunctions::get_currency_list() as $key => $country)
                                            <?php $selected = '';?>
                                            @if($key == $data->country)
                                                <?php $selected = 'selected' ?>
                                            @endif
                                            <option {{ $selected }} value="{{ $key }}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="col-md-12">Telephone</label>

                            <div class="col-md-12">
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
                                           value="{{ $data->telephone }}"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Save Button -->
                    <div class="text-center col-md-12 mt20">
                        <button type="submit" class="btn btn-lg btn-success btn-rounded mr20">
                            <span class="fa fa-save mr10"></span>
                            <span id="btnText">Update Customer</span>
                        </button>
                        <a href="{{ route('delete-customer',$data->id) }}"
                           class="btn btn-lg btn-danger btn-rounded ml20" id="deleteCustomer">
                            <span class="fa fa-times mr10"></span>
                            <span id="btnText">Delete Customer</span>
                        </a>
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
            $('#createCustomer').AjaxForm();
            $('#country').select2();

            $('#deleteCustomer').click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this customer. Warning data will be permanently deleted?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: true,
                    html : true,
                }, function () {
                    window.location.href = href;
                });


            });

        });
    </script>

@stop