<div class="panel" id="SalesAnalytic">
    <div class="panel-heading">
        <span class="panel-title fs20">Sales Analytics</span>
        <div class="pull-right">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
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
        <div id="salesAnalyticChart" style="height: 300px;"></div>
    </div>
</div>

