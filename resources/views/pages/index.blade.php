@extends('layouts.app')

@section('title')
	Home
@endsection

@section('content')
	<div class="container">
		<h3 class="page-header">All Colleges</h3>

		<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>Departments</th>
				<th>Programs</th>
				<th>Staff</th>
				<th>Students</th>
			</tr>

			@foreach($colleges as $college)
				<tr>
					<td><a href="{{$college->linkTo()}}">
						{{$college->name}}
					</a></td>
					<td>
						{{$college->departments->count()}}
					</td>
					<td>
						{{$college->programs()->count()}}
					</td>
					<td>
						{{$college->staff()->count()}}
					</td>
					<td>
						{{$college->students()->count()}}
					</td>
				</tr>
			@endforeach

				<tr>
					<th>
						Total
					</th>
					<th>
						{{$counts['department']}}
					</th>
					<th>
						{{$counts['program']}}
					</th>
					<th>
						{{$counts['staff']}}
					</th>
					<th>
						{{$counts['student']}}
					</th>

				</tr>
		</table>

    </div>
@endsection
