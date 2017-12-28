@extends('layouts.app')

@section('content')
<div class="container">
	<script type="text/javascript">
		document.title = '{{$student->name()}}' + ' - ' + document.title;
	</script>


	@if(isset($student))
	<table class="table table-striped">
		<tr><th>Name</th>
			<td>{{$student->name()}}</td>
			<td rowspan="5">
				<img src="{{$student->picture()}}" style="max-height: 180px;">
			</td>
		</tr>
		<tr><th>Student number</th><td>{{$student->student_number()}}</td></tr>
		<tr><th>Program</th>
			<td>
				<a href="/program/{{$student->program->short_name}}">
					{{$student->program->name}}
				</a></td>

			</tr>
			<tr>
				<th>Department</th>
				<td><a href="/department/{{$student->department()->short_name}}">
					{{$student->department()->name}}
				</a></td>
			</tr>
			<tr>
				<th>College</th>			
				<td><a href="/college/{{$student->college()->short_name}}">
					{{$student->college()->name}}
				</a></td>

			</tr>

		</table>


		<h4 class="page-header">
			Deficiencies
		</h4>

		<div id="deficiency-table">
			<table class="table table-striped">

				<tr>
					<th>Department</th>
					<th>Title</th>
					<th>Note</th>
					<th>Posted By</th>
					<th>Posted On</th>
					<th>Actions</th>
				</tr>


				@foreach($deficiencies as $deficiency)

				<tr>
					<td><a href="/department/{{$deficiency->department->short_name}}">
						<span class="visible-xs" title="{{$deficiency->department->name}}">
							{{strtoupper($deficiency->department->short_name)}}
						</span>
						<span class="hidden-xs">{{$deficiency->department->name}}</span>
					</a></td>

					<td>{{$deficiency->title}}</td>

					<td>{{$deficiency->note}}</td>
					<td><a href="{{$deficiency->staff->linkTo()}}">
						{{$deficiency->postedBy()}}
					</a></td>


					<td title="{{ $deficiency->postDateTime() }}">
						{{ $deficiency->postDate() }}
					</td>

					<td>
						@userInSameDepartment($deficiency->department)
						<a href="#"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
						&nbsp;
						<a href="#"><span class="glyphicon glyphicon-remove" title="Remove"></span></a>
						@enduserInSameDepartment
					</td>
				</tr>

				@endforeach

			</table>

				{{ $deficiencies->render() }}
		</div>


		@hasRole('staff')
		<a title="File deficiency" href="#" class="btn btn-danger btn-sm pull-right">ADD NEW <span class="glyphicon glyphicon-plus"></span></a>

		@endhasRole


		@endif
	</div>


	@endsection