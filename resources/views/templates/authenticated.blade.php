@include('templates.partials.head')

<body class="ecommerce-page">


<!-- Start: Main -->
<div id="main">

    <!-- Header -->
    @include('templates.partials.header')

            <!-- Sidebar -->
    @include('templates.partials.sidebar')

            <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">


        @include('templates.partials.topbar')
                <!-- Topbar -->
        @if(session()->has('alert-success'))
            <div class="alert alert-sm alert-border-left alert-success light alert-dismissable mbn">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session()->get('alert-success') }}
            </div>
        @endif
        @if(session()->has('alert-danger'))
            <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable mbn">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session()->get('alert-danger') }}
            </div>
        @endif
        @if(session()->has('alert-info'))
            <div class="alert alert-sm alert-border-left alert-info light alert-dismissable mbn">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session()->get('alert-info') }}
            </div>
            @endif

                    <!-- Main Content -->
            @yield('content')

    </section>

</div>
<!-- End: Main -->

<!-- Footer -->
@include('templates.partials.footer')


<script>
    $(window).load(function () {
        appConfig.init();
    });

    $(document).ready(function () {
        $(document).scrollTop(0);
        var
                curr_page = '@yield("curr-page")',
                selector = $('#' + curr_page);
        selector.each(function (index, value) {
            $(this).addClass('active');
            var parent = $(this).parent().parent().find('a:first');
            if (parent.hasClass('accordion-toggle')) {
                parent.addClass('menu-open')
            }

        });
    });

</script>
@yield('custom-js-2')
</body>
</html>