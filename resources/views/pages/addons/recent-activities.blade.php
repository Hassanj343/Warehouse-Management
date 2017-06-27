<!-- begin: .tray-right -->
<aside class="tray tray-right tray350 va-t pn" data-tray-height="match">

    <!-- menu quick links -->
    <div class="admin-form" id="recent-activity">

        <h4 class="mt5 text-muted fw500 pt20 pl20 pr20">
            Stock Alert
            <small class="pull-right fw200">@{{ total_items }} alerts</small>
        </h4>
        <hr class="short">

        <div>
            <div class="activity-layout">
                <div v-repeat="items" class="item @{{ status }}" v-transition="bounce" stagger="100">
                    <div class="name">
                        @{{ name }}
                    </div>
                    <div class="quantity">
                        @{{ quantity }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</aside>
<!-- end: .tray-right -->

<script>


    var vm = new Vue({
        el: '#recent-activity',

        data: {
            items: [],
            total_items: 0
        },

        ready: function () {
            this.getAlerts();
            setInterval(this.getAlerts, 300000);

        },

        methods: {

            getAlerts: function () {
                this.$http.get('{{ route('api-alert-product-stock')  }}', function (data, status, request) {

                    if (this.items.length <= 0) {
                        this.items = data;
                    } else {
                        var newItems = data.concat(this.items);
                        this.items = remove_duplicates(newItems);
                    }
                    this.items.splice(30);

                    this.total_items = this.items.length;
                })


            }
        },


    });
</script>