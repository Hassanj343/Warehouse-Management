<!-- Start: Topbar -->
<header id="topbar" class="ph10 visible-md visible-lg">
    <div class="topbar-left">
        <ul class="nav nav-list nav-list-topbar pull-left">
            <li id="dashboard">
                <a href="{{ route('homepage') }}">Dashboard</a>
            </li>
            <li id="products-manage">
                <a href="{{ route('manage-products') }}">Products</a>
            </li>
            <li>
                <a href="{{ route('manage-shipments') }}">Shipments</a>
            </li>
            <li id="customer-manage">
                <a href="{{ route('manage-customers') }}">Customers</a>
            </li>

        </ul>
    </div>
    <div class="topbar-right">
        <a href="{{ route('create-shipment') }}" class="btn btn-default btn-sm light fw600 ml10">
            <span class="fa fa-plus pr5"></span>
            New Shipment
        </a>
        <a href="{{ route('create-product') }}" class="btn btn-default btn-sm light fw600 ml10">
            <span class="fa fa-plus pr5"></span>
            Add Product
        </a>
        <a href="{{ route('create-customer') }}" class="btn btn-default btn-sm light fw600 ml10">
            <span class="fa fa-user-plus pr5"></span>
            Add Customer
        </a>
    </div>
</header>
<!-- End: Topbar -->