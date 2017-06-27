@extends('templates.guest')
@section('body-tags') id="login-bg" @endsection
@section('content')
        <!-- Start: Main -->
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
                        <span class="panel-title fg-gray">Sign in to continue</span>

                    </div>
                    <!-- end .form-header section -->
                    <form method="post" role="form" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="panel-body bg-light p30">
                            <div class="row">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger pb10">
                                    <strong>Whoops!</strong> There were some problems with your
                                    input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <div class="col-sm-12 pr30">
                                    <div class="section">
                                        <label for="username" class="field-label text-muted fs18 mb10">E-Mail</label>
                                        <label for="username" class="field prepend-icon">
                                            <input type="text" name="email" id="username" class="gui-input"
                                                   placeholder="Enter E-Mail">
                                            <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                            </label>
                                        </label> 
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!-- end section -->
                                    <div class="section">
                                        <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                        <label for="password" class="field prepend-icon">
                                            <input type="password" name="password" id="password" class="gui-input"
                                                   placeholder="Enter password">
                                            <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                            </label>
                                        </label>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!-- end section -->
                                </div>

                            </div>
                        </div>
                        <!-- end .form-body section -->
                        <div class="panel-footer clearfix p10 ph15">
                            <button type="button" data-toggle="modal" href="#recover-password"
                                    class="button btn-primary mr10 pull-right">
                                Reset Password
                            </button>
                            <button type="submit" class="button btn-primary mr10 pull-right">Login</button>
                            <label class="switch block switch-primary pull-left input-align mt10">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember" data-on="YES" data-off="NO"></label>
                                <span>Remember me</span>
                            </label>
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

@include('auth.password.recover-password')



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
            }
        });


    });
</script>
@endsection