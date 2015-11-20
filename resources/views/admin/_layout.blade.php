<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'E-Rapor')</title>
	
	<!-- Vendor Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/bootstrap/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/dataTables.bootstrap.min.css') }}">

	<!-- App Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	
	@yield('style')

</head>
<body>
	
	<div id="wrapper" class="{{ isset($toggled) ? 'toggled' : '' }}">
		
		<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"><a href="#">Admin - Control Panel</a></li>
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li><a href="#">Profile Sekolah</a></li>
                <li><a href="#">Data Akademik</a></li>
                <li><a href="#">Database</a></li>
                <li><a href="#">Pengaturan</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

		@yield('content')
	
	</div>
	
	<!-- Vendor Scripts -->
	<script type="text/javascript" src="{{ asset('js/vendor/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/dataTables.bootstrap.min.js') }}"></script>
	<script type="text/javascript"> var basePath = '{{ url() }}' </script>
	
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

	<!-- App Scripts -->
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

	@yield('script')

</body>
</html>