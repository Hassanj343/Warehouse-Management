<!-- Start: Sidebar -->
<aside id="sidebar_left" class="nano nano-primary affix" >
    <div class="nano-content">
        <!-- sidebar menu -->
        <ul class="nav sidebar-menu">
            <li id="dashboard">
                <a href="{{ route('homepage') }}">
                    <span class="glyphicons glyphicons-home"></span>
                    <span class="sidebar-title">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-archive"></span>
                    <span class="sidebar-title">Products</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="products-create">
                        <a href="{{ route('create-product') }}">
                            <span class="fa fa-pencil"></span> Create Product
                        </a>
                    </li>
                    <li id="products-manage">
                        <a href="{{ route('manage-products') }}">
                            <span class="fa fa-list"></span> Manage Products
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-user"></span>
                    <span class="sidebar-title">Suppliers</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="supplier-create">
                        <a href="{{ route('create-supplier') }}">
                            <span class="fa fa-pencil"></span> Create Supplier
                        </a>
                    </li>
                    <li id="supplier-manage">
                        <a href="{{ route('manage-suppliers') }}">
                            <span class="fa fa-list"></span> Manage Suppliers
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-users"></span>
                    <span class="sidebar-title">Group</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="group-create">
                        <a href="{{ route('create-group') }}">
                            <span class="fa fa-pencil"></span> Create Group
                        </a>
                    </li>
                    <li id="group-manage">
                        <a href="{{ route('manage-groups') }}">
                            <span class="fa fa-list"></span> Manage Groups
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="accordion-toggle" href="#">
                    <span class="imoon imoon-user"></span>
                    <span class="sidebar-title">Customer</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="customer-create">
                        <a href="{{ route('create-customer') }}">
                            <span class="fa fa-pencil"></span> Create Customer
                        </a>
                    </li>
                    <li id="customer-manage">
                        <a href="{{ route('manage-customers') }}">
                            <span class="fa fa-list"></span> Manage Customers
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-truck"></span>
                    <span class="sidebar-title">Shipment</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="reports-shipment-invoices">
                        <a href="{{ route('report-invoices') }}">
                            <span class="fa fa-files-o"></span>
                            Shipment Invoices
                        </a>
                    </li>
                    <li id="shipment-quick">
                        <a href="{{ route('create-quick-shipment') }}">
                            <span class="fa fa-pencil"></span> Quick Sell
                        </a>
                    </li>
                    <li id="shipment-create">
                        <a href="{{ route('create-shipment') }}">
                            <span class="fa fa-pencil"></span> Create Shipment
                        </a>
                    </li>
                    <li id="shipment-manage">
                        <a href="{{ route('manage-shipments') }}">
                            <span class="fa fa-pencil"></span> Manage Shipment
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-files-o"></span>
                    <span class="sidebar-title">Reports</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="reports-products-view">
                        <a href="{{ route('reports-view-products') }}">
                            <span class="fa fa-archive"></span> Products Report
                        </a>
                    </li>
                    <li id="reports-sales">
                        <a href="{{ route('report-product-sales') }}">
                            <span class="fa fa-file-o"></span> Sales Report
                        </a>
                    </li>
                    <li id="reports-group-stock">
                        <a href="{{ route('report-group-stock') }}">
                            <span class="fa fa-area-chart"></span> Group Stock Report
                        </a>
                    </li>
                    <li id="reports-stock-out">
                        <a href="{{ route('report-product-out-stock') }}">
                            <span class="fa fa-exclamation-triangle"></span> Out of Stock Report
                        </a>
                    </li>
                    <li id="report-stock-alert-level-1">
                        <a href="{{ route('report-stock-alert',1) }}">
                            <span class="fa fa-exclamation"></span> Stock Alert Level 1
                        </a>
                    </li>
                    <li id="report-stock-alert-level-2">
                        <a href="{{ route('report-stock-alert',2) }}">
                            <span class="fa fa-exclamation-circle"></span> Stock Alert Level 2
                        </a>
                    </li>
                    <li id="report-stock-alert-level-3">
                        <a href="{{ route('report-stock-alert',3) }}">
                            <span class="fa fa-exclamation-triangle"></span> Stock Alert Level 3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-download"></span>
                    <span class="sidebar-title">Export</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li id="export-products">
                        <a href="{{ route('export-products') }}">
                            <span class="fa fa-archive"></span> Export Products
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Admin Section -->
            @if(Auth::user()->is_admin)
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="fa fa-cog"></span>
                        <span class="sidebar-title">Settings</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li id="application-settings-global">
                            <a href="{{ route('settings-general') }}">
                                <span class="fa fa-pencil"></span> Global Settings
                            </a>
                        </li>
                        <li id="application-settings-users">
                            <a href="{{ route('settings-manage-users') }}">
                                <span class="fa fa-user"></span> Manage Users
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
        </ul>
        <div class="sidebar-toggle-mini">
            <a href="#">
                <span class="fa fa-sign-out"></span>
            </a>
        </div>
    </div>
</aside>