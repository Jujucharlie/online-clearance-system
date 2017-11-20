@extends('layouts.app')

@section('content')
	<div class="container">
		<script type="text/javascript">
			document.title = '{{$staff->name()}}' + ' - ' + document.title;
		</script>
		
		@if(isset($staff))
			<table class="table table-striped table-responsive">
				<tr><th>Name</th><td>{{$staff->name()}}</td></tr>
				<tr><th>Department</th>
					<td>
						<a href="/department/{{$staff->department->short_name}}">
						{{$staff->department->name}}
					</a></td>
				</tr>
					<th>College</th>			
						<td><a href="/college/{{$staff->college()->short_name}}">
								{{$staff->college()->name}}
						</a></td>
					

				</tr>
			</table>

			<hr>
			<h4>Deficiencies posted by this staff member</h4>
			<table class="table table-striped table-responsive">
				<tr>
					<th>Department</th>
					<th>Title</th>
					<th>Note</th>
					<th>Student</th>
					<th>Posted On</th>
					
					@userInSameDepartment($staff->department)
						<th>Actions</th>
					@enduserInSameDepartment
					
				</tr>
				
				@foreach($staff->posted_deficiencies() as $deficiency)
					<tr>
						<td><a href="/department/{{$deficiency->department->short_name}}">
							{{$deficiency->department->name}}
						</a></td>
						<td>{{$deficiency->title}}</td>
						<td>{{$deficiency->note}}</td>
						<td><a href="{{$deficiency->student->linkTo()}}">
							{{$deficiency->student->name()}}
						</a></td>
						<td title="{{ $deficiency->postDateTime() }}">
								{{ $deficiency->postDate() }}
						</td>
				
						@userInSameDepartment($deficiency->department)
							<td>					
								<a href="#"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
								&nbsp;
								<a href="#"><span class="glyphicon glyphicon-remove" title="Remove"></span></a>
							</td>
						@enduserInSameDepartment
					</tr>
				@endforeach
			</table>

		@else
		Not found bruh

		@endif
    </div>
@endsection

