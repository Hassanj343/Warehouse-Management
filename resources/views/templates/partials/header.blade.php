<!-- Start: Header -->
<header class="navbar navbar-fixed-top bg-light">
    <div class="navbar-branding">
        <a class="navbar-brand" href="{{ route('homepage') }}"> <b>Warehouse</b> Management </a>
        <span id="toggle_sidemenu_l" class="glyphicons glyphicons-show_lines"></span>
        <ul class="nav navbar-nav pull-right hidden">
            <li>
                <a href="#" class="sidebar-menu-toggle">
                    <span class="octicon octicon-ruby fs20 mr10 pull-right "></span>
                </a>
            </li>
        </ul>
    </div>
    <form class="navbar-form navbar-left navbar-search ml5" role="search" action="{{ route('post-search') }}">
        <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
        </div>
    </form>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img
                        src="{{ asset('assets/img/avatars/placeholder.png') }}" alt="avatar" class="mw30 br64 mr15">
                <span>{{ Auth::user()->name ? ucfirst(Auth::user()->name) : 'User'  }}</span>
                <span class="caret caret-tp hidden-xs"></span>
            </a>
            <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                <li class="br-t of-h">
                    <a href="#" class="fw600 p12 animated animated-short fadeInDown">
                        <span class="fa fa-gear pr5"></span> Account Settings </a>
                </li>
                <li class="br-t of-h">
                    <a href="{{ route('logout') }}" class="fw600 p12 animated animated-short fadeInDown">
                        <span class="fa fa-power-off pr5"></span> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</header>
<!-- End: Header -->