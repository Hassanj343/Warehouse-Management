@extends('templates.guest')

@section('content')
    <div id="main" class="animated fadeIn">

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->
            <section id="content">

                <div class="admin-form theme-info" id="login1 login-form">

                    <div class="row mb15 table-layout">

                        <div class="col-xs-12 va-m pln">
                            <img src="{{ asset('assets/img/logos/logo_white.png') }}" class="img-responsive w250">
                        </div>

                    </div>

                    <div class="panel panel-info mt10 br-n">

                        <div class="panel-heading heading-border bg-white">
                            <span class="panel-title fg-gray">Reset Password</span>

                        </div>

                        <!-- end .form-header section -->
                        <form method="post" role="form" method="post" action="{{ route('password.reset') }}">
                            <div class="panel-body bg-light p30">
                                <div class="row">
                                    <div class="col-sm-12 pr30">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your
                                                input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="section">
                                            <label for="username"
                                                   class="field-label text-muted fs18 mb10">E-Mail</label>
                                            <label for="username" class="field prepend-icon">
                                                <input type="text" name="email" id="username" class="gui-input"
                                                       placeholder="Enter E-Mail" value="{{ old('email') }}">
                                                <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                                </label>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <label for="password"
                                                   class="field-label text-muted fs18 mb10">Password</label>
                                            <label for="password" class="field prepend-icon">
                                                <input type="password" name="password" id="password" class="gui-input"
                                                       placeholder="Enter password">
                                                <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                                </label>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <label for="password_confirmation" class="field-label text-muted fs18 mb10">Confirm
                                                Password</label>
                                            <label for="password_confirmation" class="field prepend-icon">
                                                <input type="password" name="password_confirmation"
                                                       id="password_confirmation" class="gui-input"
                                                       placeholder="Confirm Password">
                                                <label for="password_confirmation" class="field-icon"><i
                                                            class="fa fa-lock"></i>
                                                </label>
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- end .form-body section -->
                            <div class="panel-footer clearfix p10 ph15">
                                <button type="submit" class="button btn-primary mr10 pull-right">Reset Password</button>
                            </div>
                            <!-- end .form-footer section -->
                        </form>
                    </div>
                </div>

            </section>
            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('custom-js')
            <!-- Page Plugins -->
    <script type="text/javascript" src="{{ asset('assets/js/pages/login/EasePack.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/login/rAF.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/login/TweenLite.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/login/login.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {

            "use strict";

            // Init Theme Core
            Core.init();


            // Init CanvasBG and pass target starting location
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });


        });
    </script>
@endsection