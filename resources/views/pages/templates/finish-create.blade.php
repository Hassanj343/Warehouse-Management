@extends('templates.authenticated')

@section('curr-page'){{ $current_page }} @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">

        <div class="panel panel-primary panel-border top lighter animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">{{ $page_title }}</span>
            </div>
            <div class="panel-body">
                <div class="text-center">
                    <h2>{{ $message }}</h2>
                </div>
                <hr>
                <div class="text-center">
                @foreach($buttons as $btn)
                    <a href="{{ $btn['href'] }}" class="{{ $btn['class'] }}" title="{{ $btn['title'] }}">
                        {{ $btn['title'] }}
                    </a>
                @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->

@stop

@section('custom-js')

@stop