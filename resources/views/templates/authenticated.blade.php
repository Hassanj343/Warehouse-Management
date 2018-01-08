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
        @include('flash::message')
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