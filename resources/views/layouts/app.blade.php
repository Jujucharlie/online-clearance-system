<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'UP Manila')</title>

    <!-- Styles -->
	<link rel="icon" href="{{ asset('images/upm-favicon.png') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
       
		@include('layouts.navbar')

		<div id="content">
			@yield('content')
		</div>

		@include('layouts.footer')

    </div>

    <!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

	@include("layouts.autocompletescript")
	@include("layouts.requestclearancescript")

</body>
</html>
