@extends('templates.authenticated')



@section('content')
        <!-- Begin: Content -->
<?php
$customer = $shipment->getCustomer;
?>
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">
        <form class="form-horizontal" role="form" action="{{ route('post-generate-invoice',$shipment->id) }}" id="generateInvoice"
              method="post">
              {{ csrf_field() }}
            <div class="panel panel-default lighter animated fadeIn" id="panelUser">
                <div class="panel-heading">
                    <span class="panel-title fs16" id="panel-title">Generate Invoice</span>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-6">
                        <label for="invoice_reference" class="col-lg-2 control-label">Reference #</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa">#</i>
                                    </span>
                                <input autocomplete="off"
                                       id="invoice_reference"
                                       class="form-control"
                                       name="invoice_reference"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="invoice_date" class="col-lg-2 control-label">Date</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                <input autocomplete="off"
                                       id="invoice_date"
                                       class="form-control"
                                       name="invoice_date"
                                        value="{{ date('d-m-Y') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="invoice_tax" class="col-lg-2 control-label">Tax</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa">%</i>
                                    </span>
                                <input autocomplete="off"
                                       id="invoice_tax"
                                       class="form-control"
                                       name="invoice_tax"
                                       type="number"
                                       max="100"
                                        value="{{ \HelperFunctions::getSettings('general-tax-rate') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary panel-border top lighter animated fadeIn" id="panelUser">
                <div class="panel-heading">
                    <span class="panel-title" id="panel-title">Customer</span>
                </div>
                <div class="panel-body">
                    <div id="ajax-response"></div>
                    <!-- Customer -->
                    <div class="form-group col-lg-6">
                        <label for="customer_name" class="col-lg-2 control-label">Name</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                    </span>
                                <input autocomplete="off"
                                       id="customer_name"
                                       class="form-control"
                                       name="customer_name"
                                       placeholder="Customer Name"
                                       value="{{ $customer->name ? $customer->name : '' }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="customer_address" class="col-lg-2 control-label">Address</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                <input autocomplete="off"
                                       id="customer_address"
                                       class="form-control"
                                       name="customer_address"
                                       value="{{ $customer->address ? $customer->address : '' }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="customer_city" class="col-lg-2 control-label">City</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                <input autocomplete="off"
                                       id="customer_city"
                                       class="form-control"
                                       name="customer_city"
                                       value="{{ $customer->city ? $customer->city : '' }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="country" class="col-lg-2 control-label">Country</label>

                        <div class="col-lg-10">
                            <div class="">
                                <select name="customer_country" class="form-control" id="country" tabindex="4">
                                    <option value="" selected>Select Country</option>
                                    @foreach(\HelperFunctions::get_currency_list() as $key => $country)
                                        @if($customer->country == $key)
                                            <option value="{{ $key }}" selected>{{$country}}</option>
                                        @else
                                            <option value="{{ $key }}">{{$country}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="customer_email" class="col-lg-2 control-label">E-Mail</label>

                        <div class="col-lg-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                <input autocomplete="off"
                                       id="customer_email"
                                       class="form-control"
                                       name="customer_email"
                                       type="email"
                                       value="{{ $customer->email ? $customer->email : '' }}"/>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <div class="text-center col-md-12">
                <button type="submit" class="btn btn-rounded btn-success">
                    <span class="fa fa-download mr10"></span>
                    <span id="btnText">Download Invoice</span>
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
    <script type="text/javascript" src="{{ asset('vendor/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $("#country").select2();
            $('#invoice_date').datepicker();
        });
    </script>

@stop