@extends('templates.admin')

@section('curr-page')application-settings-global @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <form action="{{ route('post-settings-general') }}" method="post" id="generalSettings">
    {{ csrf_field() }}
        <!-- begin: .tray-center -->
        <div class="tray tray-center p25 va-t posr">

            <div class="loading-overlay">
                <p class="loading-spinner">
                    <span class="loading-icon"></span>
                    <span class="loading-text">processing</span>
                </p>
            </div>

            <div id="ajax-response"></div>

            <!-- Warehouse Settings -->
            <div class="panel panel-primary panel-border top mb35">
                <div class="panel-heading">
                    <span class="panel-title">Warehouse Settings</span>

                </div>
                <div class="panel-body bg-light dark">
                    <div class="admin-form">

                        <!-- Tax Rate -->
                        <div class="section row mb10">
                            <label for="general-tax-rate" class="field-label col-md-3 text-center">Tax Rate :</label>

                            <div class="col-md-9">
                                <label for="general-tax-rate" class="field prepend-icon">
                                    <input type="text" name="general-tax-rate" id="general-tax-rate" class="gui-input"
                                           value="{{ $data['general-tax-rate'] ? $data['general-tax-rate'] : 20 }}"
                                           placeholder="Tax Rate" required="required">
                                    <label for="general-tax-rate" class="field-icon"><i class="fa ">%</i>
                                    </label>
                                </label>
                            </div>
                        </div>

                        <!-- Currency -->
                        <div class="section row mb10">
                            <label for="currency" class="field-label col-md-3 text-center">Currency :</label>

                            <div class="col-md-9">
                                <!-- Product Group -->
                                <div class="section mb10">
                                    <select name="general-currency" class="form-control" id="currency">
                                        @foreach(\HelperFunctions::get_currency_list() as $currency => $country)
                                            @if($currency == $data['general-currency'])
                                                <option value="{{ $currency }}" selected>{{ $country }}
                                                    - {{ $currency }}</option>
                                            @else
                                                <option value="{{ $currency }}">{{ $country }}
                                                    - {{ $currency }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="warning-level-1" class="field-label col-md-3 text-center">Warning Level
                                1</label>

                            <div class="col-md-9">
                                <label for="warning-level-1" class="field prepend-icon">
                                    <input type="text" name="warning-level-1" id="warning-level-1" class="gui-input"
                                           value="{{ $data['warning-level-1'] ? $data['warning-level-1'] : 20 }}"
                                           placeholder="Warning Level 1 - Lowest Alert Level">
                                    <label for="warning-level-1" class="field-icon fa-cyan"><i
                                                class="fa fa-exclamation-triangle fg-cyan"></i>
                                    </label>
                                </label>
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="warning-level-2" class="field-label col-md-3 text-center">Warning Level
                                2</label>

                            <div class="col-md-9">
                                <label for="warning-level-2" class="field prepend-icon">
                                    <input type="text" name="warning-level-2" id="warning-level-2" class="gui-input"
                                           value="{{ $data['warning-level-2'] ? $data['warning-level-2'] : 10 }}"
                                           placeholder="Warning Level 2 - Medium Alert Level">
                                    <label for="warning-level-2" class="field-icon fg-orange"><i
                                                class="fa fa-exclamation-triangle fg-orange"></i>
                                    </label>
                                </label>
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="warning-level-3" class="field-label col-md-3 text-center">Warning Level
                                3</label>

                            <div class="col-md-9">
                                <label for="warning-level-3" class="field prepend-icon">
                                    <input type="text" name="warning-level-3" id="warning-level-3" class="gui-input"
                                           value="{{ $data['warning-level-3'] ? $data['warning-level-3'] : 5 }}"
                                           placeholder="Warning Level 3 - Highest Alert Level">
                                    <label for="warning-level-3" class="field-icon fg-red"><i
                                                class="fa fa-exclamation-triangle fg-red"></i>
                                    </label>
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Warehouse Policies -->
            <div class="panel panel-success panel-border top mb35">
                <div class="panel-heading">
                    <span class="panel-title">Warehouse Policies <small class="pull-right fs12 fw300">This will be
                            displayed on 2nd page of invoice
                        </small></span>
                </div>
                <div class="panel-body bg-light dark">
                    <div class="admin-form">

                        <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-md-3 text-center">Refund Policy</label>

                            <div class="col-md-9">
                                <label class="field prepend-icon">
                                    <textarea class="gui-textarea" id="refund-policy" name="refund-policy"
                                              placeholder="Describe your return policy and conditions here...">{{ $data['refund-policy']}}</textarea>
                                    <label for="refund-policy" class="field-icon"><i class="fa fa-usd"></i>
                                    </label>
                                </label>
                            </div>
                        </div>

                        <div class="section row mb25">
                            <label for="privacy-policy" class="field-label col-md-3 text-center">Privacy Policy</label>

                            <div class="col-md-9">
                                <label class="field prepend-icon">
                                    <textarea class="gui-textarea" id="privacy-policy" name="privacy-policy"
                                              placeholder="Describe the data your store, collect, and handle here...">{{ $data['privacy-policy'] }}</textarea>
                                    <label for="privacy-policy" class="field-icon"><i class="fa fa-edit"></i>
                                    </label>
                                </label>
                            </div>
                        </div>

                        <div class="section row mb15">
                            <label for="store-tos" class="field-label col-md-3 text-center">Terms of Service</label>

                            <div class="col-md-9">
                                <label class="field prepend-icon">
                                    <textarea class="gui-textarea" id="store-tos" name="store-tos"
                                              placeholder="Describe any business protocols or methodologies here...">{{ $data['store-tos'] }}</textarea>
                                    <label for="store-tos" class="field-icon"><i class="fa fa-edit"></i>
                                    </label>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-lg btn-rounded btn-success" type="submit">
                    <span class="fa fa-save"></span>
                    Save Settings
                </button>
            </div>

        </div>
        <!-- end: .tray-center -->

    </form>

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->
@stop

@section('custom-js')
    <script src="{{ asset('scripts/general/general-datatable.js') }}"></script>
    <script src="{{ asset('scripts/vuejs/settings/general.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#currency').select2();
            $('#generalSettings').AjaxForm();
        });

    </script>
@stop