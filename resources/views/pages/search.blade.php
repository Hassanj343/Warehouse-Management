@extends('templates.authenticated')

@section('curr-page')shipment-manage @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr" id="searchSelector">

        <!-- Admin-panels -->
        <div class="admin-panels fade-onload sb-l-o-full">

            <div class="row mb30">
                <div class="col-md-12">
                    <div class="panel br-t bw5 br-grey mn">

                        <div class="panel-body pn">
                            <div class="p25 br-b">
                                <h2 class="fw200 mb20 mt10">Search</h2>

                                <form action="{{ route('post-search') }}">
                                    <div class="input-group input-group-merge input-hero mb30">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="icon-filter" class="form-control" value="{{ $oldInput }}" placeholder="Enter Something to Search">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-search mr10"></i>
                                            Search
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- full width widgets -->
            <div class="row">
                <!-- Three panes -->
                <div class="col-md-12 admin-grid">
                    <div class="panel sort-disable" id="p0">
                        <div class="panel-heading">
                            <span class="panel-title">Search Result</span>
                        </div>
                        <div class="panel-body mnw700 of-a">
                            <div class="row">

                                <div class="col-md-4 br-r">
                                    <h5 class="mt5 mbn ph10 pb5 br-b fw700">Products
                                        <small class="pull-right fw700 text-primary">Actions</small>
                                    </h5>
                                    <table class="table mbn tc-med-1 tc-bold-last tc-fs13-last">
                                        <thead>
                                        <tr class="hidden">
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $key => $value)

                                                <tr>
                                                    <td>
                                                        <i class="fa fa-circle text-warning fs8 pr15"></i>
                                                        <span>{{ $value->name }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="fw500">View</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-md-4 br-r">
                                    <h5 class="mt5 mbn ph10 pb5 br-b fw700">Customers
                                        <small class="pull-right fw700 text-primary">Actions</small>
                                    </h5>
                                    <table class="table mbn tc-med-1 tc-bold-last tc-fs13-last">
                                        <thead>
                                        <tr class="hidden">
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $key => $value)

                                                <tr>
                                                    <td>
                                                        <i class="fa fa-circle text-warning fs8 pr15"></i>
                                                        <span>{{ $value->name }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="fw500">View</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-md-4 br-r">
                                    <h5 class="mt5 mbn ph10 pb5 br-b fw700">Groups
                                        <small class="pull-right fw700 text-primary">Actions</small>
                                    </h5>
                                    <table class="table mbn tc-med-1 tc-bold-last tc-fs13-last">
                                        <thead>
                                        <tr class="hidden">
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($groups as $key => $value)

                                                <tr>
                                                    <td>
                                                        <i class="fa fa-circle text-warning fs8 pr15"></i>
                                                        <span>{{ $value->name }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="fw500">View</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Icon Column -->
                                <div class="col-md-4 hidden">
                                    <h5 class="mt5 ph10 pb5 br-b fw700">Content Viewed
                                        <small class="pull-right fw700 text-primary">Refresh</small>
                                    </h5>
                                    <table class="table mbn">
                                        <thead>
                                        <tr class="hidden">
                                            <th class="mw30">#</th>
                                            <th>First Name</th>
                                            <th>Revenue</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="fs17 text-center w30">
                                                <span class="fa fa-desktop text-warning"></span>
                                            </td>
                                            <td class="va-m fw600 text-muted">Television</td>
                                            <td class="fs14 fw700 text-muted text-right"><i
                                                        class="fa fa-caret-up text-info pr10"></i>$855,913
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fs17 text-center">
                                                <span class="fa fa-microphone text-primary"></span>
                                            </td>
                                            <td class="va-m fw600 text-muted">Radio</td>
                                            <td class="fs14 fw700 text-muted text-right"><i
                                                        class="fa fa-caret-down text-danger pr10"></i>$349,712
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fs17 text-center">
                                                <span class="fa fa-newspaper-o text-info"></span>
                                            </td>
                                            <td class="va-m fw600 text-muted">Newspaper</td>
                                            <td class="fs14 fw700 text-muted text-right"><i
                                                        class="fa fa-caret-up text-info pr10"></i>$1,259,742
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fs17 text-center">
                                                <span class="fa fa-facebook text-alert"></span>
                                            </td>
                                            <td class="va-m fw600 text-muted">Social Media</td>
                                            <td class="fs14 fw700 text-muted text-right"><i
                                                        class="fa fa-caret-up text-info pr10"></i>$3,512,672
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fs17 text-center">
                                                <span class="fa fa-bank text-alert"></span>
                                            </td>
                                            <td class="va-m fw600 text-muted">Investments</td>
                                            <td class="fs14 fw700 text-muted text-right"><i
                                                        class="fa fa-caret-up text-info pr10"></i>$3,512,672
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: .col-md-12.admin-grid -->
        </div>
        <!-- end: .row -->
    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')
</section>
<!-- End: Content -->
@stop
