@extends('layouts.app')

@section('content')
	<div class="container">
		<a class="btn btn-lg btn-success" href="{{ route('glogin') }}">
			<span class="glyphicon glyphicon-log-in"></span>
			&nbsp;&nbsp;Google</a>

		API KEY: {{ config('services.oauth_api_key') }}
	</div>
@endsection
