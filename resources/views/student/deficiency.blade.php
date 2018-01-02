@extends('layouts.app')

@section('content')
<div class="container">
	@include('student.information')

	<table class="table table-striped">
		<tr>
			<th>Title</th>
			<td>{{$deficiency->title}}</td>	
		</tr>

		<tr>
			<th>Note</th>	
			<td>{{$deficiency->note}}</td>
		</tr>	

		<tr>
			<th>Department</th>
			<td>{{$deficiency->department->name}}</td>
		</tr>

		<tr>
			<th>Staff</th>
			<td>{{$deficiency->staff->name()}}</td>
		</tr>

		<tr>
			<th>Posted On</th>
			<td>{{$deficiency->postDate()}}</td>
		</tr>

		<tr>
			<th>Completion Status</th>
			<td>{{$deficiency->completionStatus()}}</td>
		</tr>
	</table>
</div>
@endsection