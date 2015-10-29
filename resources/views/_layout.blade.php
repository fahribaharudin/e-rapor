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

</head>
<body>

	@yield('content')
	
	<!-- Vendor Scripts -->
	<script type="text/javascript" src="{{ asset('js/vendor/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/dataTables.bootstrap.min.js') }}"></script>
	
	<!-- App Scripts -->
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	
	@yield('script')

</body>
</html>