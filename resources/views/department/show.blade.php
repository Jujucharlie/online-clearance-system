@extends('layouts.app')

@section('content')
	<div class="container">
		<script type="text/javascript">
			document.title = '{{$department->name}}' + ' - ' + document.title;
		</script>
		<h3>{{$department->name}}</h3>
		<h4>
			<a href="/college/{{$department->college->short_name}}">
				{{$department->college->name}}
			</a>
		</h4>

		<hr>
		<h4>Programs</h4>
		<table class="table table-striped">
			<tr>
				<th>Name</th> <th>Number of students</th>
			</tr>
			@foreach($department->programs as $program)
			<tr>
				<td><a href="/program/{{$program->short_name}}">
					{{$program->name}}
				</a></td>

				<td>
					{{$program->students->count()}}
				</td>
			</tr>
			@endforeach

			<tr>
				<th>Total</th>
				<td>{{$department->students()->count()}}</td>
			</tr>
		</table>

		<hr>
		<h4>Staff Members</h4>
		<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>Total Deficiencies Posted</th>
			</tr>
			@foreach($department->staff as $staff)
			<tr>
				<td><a href="{{$staff->linkTo()}}">
					{{$staff->name()}}
				</a></td>

				<td>{{$staff->deficiencies->count()}}</td>
			</tr>
			@endforeach

		</table>
    </div>
@endsection