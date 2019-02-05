<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title', 'La Cascada')</title>
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ionicons/dist/css/ionicons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/icon-kit/dist/css/iconkit.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
		<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.css') }}">

		@stack('css')
		@if(Auth::user()->role == 'admin')
			<style>
				header{
					padding-left: 14%;
				}
				.total-content{
					width: 102%;
				}
			</style>
		@elseif(Auth::user()->role == 'cliente')
			<style>
				header{
					padding-left: 37%;
				}
				.total-content{
					width: 140%;
				}
			</style>
		@endif
	</head>
	<body>
		@include('layouts.nav')
        <div class="content-wrapper">
			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Excelente!</strong> {{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="ik ik-x"></i>
					</button>
				</div>
			@elseif(session('info'))
				<div class="alert alert-info alert-dismissible fade show" role="alert">
					<strong>Disculpe!.</strong> {{ session('info') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="ik ik-x"></i>
					</button>
				</div>
			@elseif(session('error') || $errors->any())
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					@if(session('error'))
					<strong>Atención!.</strong> {{ session('error') }}
					@else
					<strong>Atención!.</strong> Registro no Procesado!, Intentelo nuevamente.
					@endif
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="ik ik-x"></i>
					</button>
				</div>
			@endif
            @yield('content')
		</div>
		
		<!-- Scripts -->
		<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script src="{{ asset('js/vue.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/axios.js') }}"></script>
		<script src="{{ asset('js/sweetalert.min.js') }}"></script>
		<script src="{{ asset('js/toastr.js') }}"></script>
		<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ asset('js/select2.min.js') }}"></script>
		<script src="{{ asset('js/datatables.js') }}"></script>
		<script>
			let route = {!! json_encode(url('/')) !!}
		</script>
		@stack('scripts')
	</body>
</html>