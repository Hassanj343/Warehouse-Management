<!-- recent activity table -->
<div class="panel" id="TrendingProducts">
    <div class="panel-heading">
        <span class="panel-title fs20">Trending Products</span>

        <div class="pull-right">
            <div class="dropdown visible-md-block visible-lg-block">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown">
                    <i class="fa fa-calendar"></i>
                    Filter
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="javascript:void(0)" v-on="click : changeRange('week')">Week</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" v-on="click : changeRange('month')">Month</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" v-on="click : changeRange('year')">Year</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel-body pn">
        <table class="table admin-form theme-warning fs13 table-responsive" id="dataTable">
            <thead>
            <tr class="bg-light">
                <th class="">Product Title</th>
                <th class="">Code</th>
                <th class="">Quantity Sold</th>
                <th class="">Quantity Available</th>
                <th class="visible-md-block visible-lg-block">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-repeat="products">
                <td><a href="{{ \URL::to('/products/view') }}/@{{ product_id }}">@{{ name }}</a></td>
                <td class="">@{{ barcode }}</td>
                <td class="">@{{ quantity_sold }}</td>
                <td class="">@{{ quantity }}</td>
                <td class="text-right visible-md-block visible-lg-block">
                    <div class="btn-group text-right">
                        <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false"> Active
                            <span class="caret ml5"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ \URL::to('/products/view') }}/@{{ product_id }}">View</a>
                            </li>
                            <li>
                                <a href="{{ \URL::to('/products/modify') }}/@{{ product_id }}">Edit</a>
                            </li>

                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>


    var vm = new Vue({
        el: '#TrendingProducts',

        data: {
            products: [],
            range: 'month',

        },

        ready: function () {
            this.getTrendingProducts();
            //setInterval(this.getTrendingProducts, 180000);
        },

        methods: {

            changeRange: function (range) {
                this.range = range;
                this.getTrendingProducts();
            },

            getTrendingProducts: function () {
                var uri = '/dashboard/trending-products/' + this.range;
                this.$http.get(uri, function (data, status, request) {
                    this.products = data;
                })


            }
        },


    });
</script>