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
	<script
		 src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

	<script>
		jQuery(document).ready(function($){
			// Set the options for Bloodhound suggestion engine

			var engine = new Bloodhound({
				remote: {
					 url: '{{route("autocomplete") }}?q=%QUERY%',
					 wildcard: '%QUERY%'
				},

				datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
				queryTokenizer: Bloodhound.tokenizers.whitespace
			});

			$("#search_text").typeahead({
				hint: true,
				highlight: true,
				minLength: 3,
			},

			{
				source: engine.ttAdapter(),
				display: function(data){
					return data.user.name;
					},
				// This will be appended to "tt-dataset-" to form the class name
				// suggestion menu

				// the key from the array to display

				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"> <div class="list-group-item">No results found.</div> </div>'
					],

					suggestion: function(data){
						var email = data.user.email;
						var name = data.user.name;
						var program = data.program.name;
						var student_number = data.student_number;
						var slug = data.slug;

						return  "<a href='/student/" + slug + 
								"' class='list-group-item'>" + 
									name + "<br/>" +
									student_number + "<br/>" +
									program + "<br/>" +
									email + "<br/>" +
								"</a>";


					},

					pending: [ '<div class="list-group search-results-dropdown"> <div class="list-group-item">Searching... </div> </div>']
				}

			});

		});
	</script>


</body>
</html>
