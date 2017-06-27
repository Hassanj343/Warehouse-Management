@extends('templates.admin')

@section('curr-page')application-settings-users @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">
        <div class="text-right mb10 mt5">
            <a href="{{ route('settings-create-user') }}" class="btn btn-dark btn-success">
                <span class="fa fa-plus mr5 fa-lg"></span>
                Create User
            </a>
        </div>

        <!-- Manage Users -->
        <div class="panel panel-primary panel-border top mb35">
            <div class="panel-heading">
                        <span class="panel-title">
                            Manage Users
                        </span>

            </div>
            <div class="panel-body bg-light light">
                <div id="ajax-result"></div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\User::all(array('name','email','id','role','status')) as $key => $user)
                        <tr>
                            <td>{{ ucfirst($user->name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ ucfirst($user->status) }}</td>

                            <td class="text-center">
                                <div class="btn-group text-right">
                                    <button type="button" class="btn btn-primary br2 fs12 dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                        <span class="fa fa-pencil mr10"></span>
                                        Manage
                                        <span class="caret ml5"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('settings-update-user',$user->id) }}">Modify User</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('settings-delete-user',$user->id) }}" class="deleteUser">Delete
                                                User</a>
                                        </li>


                                    </ul>
                                </div>
                            </td>


                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')

</section>
<!-- End: Content -->

@stop

@section('custom-js')
    <script src="{{ asset('scripts/general/general-datatable.js') }}"></script>
    <script>
        $(document).ready(function () {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".deleteUser").click(function (e) {
                e.preventDefault();
                console.log('hello sir');
                var href = $(this).attr('href');
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this user. Warning data will be permanently deleted?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: true,
                    html : true,
                }, function () {
                    $.get(href, function (data) {
                        if (data.result = 'success') {
                            var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    data.message +
                                    '</div>';
                            $("#ajax-result").html(html);
                            setTimeout(function () {
                                window.location.reload()
                            }, 3000);

                        } else if (data.result == 'error') {
                            var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    data.message +
                                    '</div>';
                            $("#ajax-result").html(html);
                        }
                    });
                });
            });
        });
    </script>

@stop