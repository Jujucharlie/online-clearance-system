@extends('layouts.app')

@section('content')
<div class="container">
	@include('student.information')

	<h3 class="page-heading">Deficiency Information</h3>

	<table class="table table-striped">
		@if($deficiency)
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

		@else
		<tr>
			<th>Item not found.</th>
		</tr>

		@endif
		
	</table>
</div>
@endsection