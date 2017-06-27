@extends('templates.admin')

@section('curr-page')application-settings-users @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">

        <div class="panel panel-info panel-border top darker animated fadeIn" id="panelUser">
            <div class="panel-heading">
                <span class="panel-title" id="panel-title">Modify User - {{ ucfirst($user->name) }}</span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{ route('post-settings-update-user',$user->id) }}"
                      id="userForm" role="form" autocomplete="off">
    {{ csrf_field() }}
                      
                    <div id="ajax-response"></div>

                    <div class="form-group">
                        <label for="name" class="col-lg-3 control-label">Name</label>

                        <div class="col-lg-8">
                            <input id="name" name="name" class="form-control" placeholder="Name" type="text"
                                   value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">E-Mail Address</label>

                        <div class="col-lg-8">
                            <input id="email" name="email" class="form-control" placeholder="E-Mail Address"
                                   type="email" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">Role</label>

                        <div class="col-lg-8 field select">
                            <select class="form-control" name="role" id="">
                                <option id="administrator" value="administrator">Administrator</option>
                                <option id="user" value="user">User</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label">Password</label>

                        <div class="col-lg-8">
                            <input name="password" class="hidden" type="password" value="">
                            <input id="password" name="password" class="form-control" placeholder="Password"
                                   type="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="repeat_password" class="col-lg-3 control-label">Repeat Password</label>

                        <div class="col-lg-8">
                            <input id="repeat_password" name="repeat_password" class="form-control"
                                   placeholder="Repeat Password" type="password" value="">
                        </div>
                    </div>

                    <div class="text-center col-md-12">
                        <button type="submit" class="btn btn-lg btn-success">
                            <span class="fa fa-save mr10"></span>
                            <span id="btnText">Submit</span>
                        </button>
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
    <script>
        $(document).ready(function () {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $("#userForm").AjaxForm();

            $('#' + '{{ $user->role }}').prop('selected', 'selected');

        });
    </script>

@stop