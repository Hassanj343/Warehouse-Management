<div class="row" id="dashboardTiles">
    <div class="col-sm-4 col-xl-3">
        <div class="panel panel-tile text-center br-a br-grey">
            <div class="panel-body">
                <h1 class="fs35 mt5 mbn">@{{ info.products_today }}</h1>
            </div>
            <div class="panel-footer">
                <span class="text-primary fs14">Products Sold Today</span>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xl-3">
        <div class="panel panel-tile text-center br-a br-grey">
            <div class="panel-body">
                <h1 class="fs35 mt5 mbn">@{{ info.shipment_today }}</h1>
            </div>
            <div class="panel-footer">
                <span class="text-success fs12">Shipments Created Today</span>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xl-3">
        <div class="panel panel-tile text-center br-a br-grey">
            <div class="panel-body">
                <h1 class="fs35 mt5 mbn">@{{ info.products_low_stock }}</h1>
            </div>
            <div class="panel-footer">
                <span class="text-warning fs14">Products Low Stock</span>
            </div>
        </div>

    </div>
    <div class="col-sm-3 col-xl-3 visible-xl">
        <div class="panel panel-tile text-center br-a br-grey">
            <div class="panel-body">
                <h1 class="fs35 mt5 mbn">@{{ info.products_out_stock }}</h1>
            </div>
            <div class="panel-footer">
                <span class="text-danger fs14">Products Out of Stock</span>
            </div>
        </div>
    </div>
</div>

<script>


    var vm = new Vue({
        el: '#dashboardTiles',

        data: {
            info: {},
        },

        ready: function () {
            this.getDashboardTiles();
            setInterval(this.getDashboardTiles, 180000);

        },

        methods: {


            getDashboardTiles: function () {
                var uri = '{{ route('get-dashboard-tiles') }}';
                this.$http.get(uri, function (data, status, request) {
                    this.info = data;
                })


            }
        },


    });
</script>