@include('templates.partials.head')
<body class="external-page sb-l-c sb-r-c" @yield('body-tags')>
	@include('flash::message')
@yield('content')

@include('templates.partials.footer')

</body>