@extends('templates.authenticated')
@section('curr-page')dashboard @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- dashboard tiles -->
        @include('dashboard.dashboard-tiles')

                <!-- Trending Products Chart -->

        @include('dashboard.trending-products')
                <!-- Trending Products Chart -->

        <div class="row visible-md-block visible-lg-block">
            <div class="col-lg-6">
                @include('dashboard.trending-products-chart')
            </div>
            <div class="col-lg-6">
                @include('dashboard.product-stock-chart')
            </div>

        </div>

        <!-- Sales Chart -->
        @include('dashboard.sales-analytic')




    </div>
    <!-- end: .tray-center -->
    <!-- begin: .tray-right -->
    @include('pages.addons.recent-activities')
            <!-- end: .tray-right -->

</section>
<!-- End: Content -->
@stop

@section('custom-js')
    <script type="text/javascript" src="{{ asset('scripts/vuejs/addons/sales-analytic.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/vuejs/addons/trending-products-chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/vuejs/addons/product-stock-chart.js') }}"></script>

@stop