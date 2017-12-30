@extends('layouts.app')

@section('content')
<div class="container">
	<script type="text/javascript">
		document.title = '{{$student->name()}}' + ' - ' + document.title;
	</script>

	@php
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
		}
		else $sort = null;
		if(isset($_GET['order'])){
			$order = $_GET['order'];
		}
		else $order = null;
	@endphp


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
					{{ $student->college()->name }}
				</a></td>

			</tr>

		</table>


		<h4 class="page-header">
			Deficiencies
		</h4>

		<div id="deficiency-table">
			<table class="table table-striped">

				<tr>
					<th>
						<a href="{{ url()->current() . "?sort=department&page=1&order="}}
							@if($sort=="department" && $order=="asc")
							desc
							@else
							asc
							@endif
							">Department
							@if($sort=="department")
								@include('helpers.glyphiconchevron')
							@endif
						</a>
					</th>
					<th>
						<a href="{{ url()->current() . "?sort=title&page=1&order="}}
							@if($sort=="title" && $order=="asc")
							desc
							@else
							asc
							@endif
							">Title
							@if($sort=="title")
								@include('helpers.glyphiconchevron')
							@endif
						</a>
					</th>
					<th>Note</th>
					<th>
						<a href="{{ url()->current() . "?sort=staff&page=1&order="}}
							@if($sort=="staff" && $order=="asc")
							desc
							@else
							asc
							@endif
							">Posted By
							@if($sort=="staff")
								@include('helpers.glyphiconchevron')
							@endif
						</a>
					</th>
					<th>
						<a href="{{ url()->current() . "?sort=date&page=1&order="}}
							@if($sort=="date" && $order=="desc")
							asc
							@else
							desc
							@endif
							">Posted On
							@if($sort=="date")
								@include('helpers.glyphiconchevron')
							@endif

						</a>
					</th>
						@hasRole('staff')	
							<th>Actions</th>
						@endhasRole
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
								{{Form::open(['method' => 'DELETE', 'route' => ['deficiency.destroy', $deficiency->id]])}}

									{{Form::button('<span class="glyphicon glyphicon-trash" title="Delete"></span>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) }}	
								{{ Form::close()}}
{{-- 						<a href="#"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
						&nbsp;
						<a href="#"><span class="glyphicon glyphicon-remove" title="Remove"></span></a>
 --}}						@enduserInSameDepartment
					</td>
				</tr>

				@endforeach

			</table>

				{{ $deficiencies->appends(['sort' => $sort, 'order' => $order])->render() }}
		</div>


		@hasRole('staff')
		<a title="File deficiency" href="#" class="btn btn-danger btn-sm pull-right">ADD NEW <span class="glyphicon glyphicon-plus"></span></a>

		@endhasRole


		@endif
	</div>


	@endsection