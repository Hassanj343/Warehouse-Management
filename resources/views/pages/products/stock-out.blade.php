@extends('templates.authenticated')

@section('curr-page')product-stock-in @stop

@section('content')
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center p25 va-t posr">
        <form class="form-horizontal" role="form" action="{{ route('post-stock-out-product',$data->id) }}"
              id="createGroup" method="post">
              {{ csrf_field() }}
            <div class="panel panel-danger panel-border top lighter animated fadeIn" id="panelUser">
                <div class="panel-heading">
                    <span class="panel-title" id="panel-title">Stock Out - {{ $data->name }}</span>
                </div>
                <div class="panel-body">
                    <div class="form-group text-center">
                        <label for="name" class="col-md-12">Stock Available</label>
                        <label for="name" class="col-md-12 text-left">{{ $data->quantity }}</label>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-12">Quantity</label>

                        <div class="col-md-12">
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tags"></i>
                                        </span>
                                <input autocomplete="off"
                                       id="name"
                                       class="form-control"
                                       name="quantity"
                                       type="number"
                                       placeholder="Quantity"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Save Button -->
            <div class="text-center col-md-12">
                <button type="submit" class="btn btn-lg btn-success">
                    <span class="fa fa-save mr10"></span>
                    <span id="btnText">Submit</span>
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

    <script>

        $(document).ready(function () {
            //     $('#createGroup').AjaxForm();
        });
    </script>

@stop