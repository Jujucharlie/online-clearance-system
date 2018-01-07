@extends('layouts.app')

@section('content')
	<div class="container">
		<script type="text/javascript">
document.title = '{{$student->name()}}' + ' - ' + document.title;
		</script>

		@if(isset($student))

			@include('student.information')

			<h4 class="page-header">
				Deficiencies
			</h4>

			<div id="def">
				@include('flash::message')

				<table class="table table-striped">

					<tr>
						<th>
							<a href="{{ url()->current() 
								. "?sort=department&page=1&order="}}
							@if($sort=="department" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Department
							@if($sort=="department")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>
						<th>
							<a href="{{ url()->current()
								. "?sort=title&page=1&order="}}
							@if($sort=="title" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Title
							@if($sort=="title")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>

						<th class="visible-md visible-lg 
							visible-xl hidden-sm hidden-xs">
							Note</th>
						<th>
							<a href="{{ url()->current() 
								. "?sort=staff&page=1&order="}}
							@if($sort=="staff" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Posted By
							@if($sort=="staff")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>
						<th>
							<a href="{{ url()->current() 
								. "?sort=date&page=1&order="}}
							@if($sort=="date" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Posted On
							@if($sort=="date")
								@include('helpers.sorticons')
							@endif

							</a>
						</th>
						@hasRole('staff')	
						<th>Actions</th>
					@endhasRole
					</tr>

					@foreach($deficiencies as $deficiency)

						<tr>
							<td title="{{$deficiency->dept_name}}" 
								data-toggle="tooltip">
								@hasRole('staff')
								<a 
									href="/department/{{$deficiency
															->dept_short_name}}">
							@endhasRole
							<span class="visible-sm visible-xs" >
								{{strtoupper($deficiency->dept_short_name)}}
							</span>
							<span class="hidden-sm hidden-xs visible-md">
								{{str_limit($deficiency->dept_name, 20)}}
							</span>
							<span class="hidden-md visible-lg hidden-xl">
								{{str_limit($deficiency->dept_name, 35)}}
							</span>

							@hasRole('staff')
								</a>
							@endhasRole
							</td>
							<td data-toggle="tooltip" 
								title="{{$deficiency->title}}">
								<a href="{{Deficiency::find($deficiency->id)
															->linkTo()}}">						
									<span class="hidden-lg">
										{{str_limit($deficiency->title, 25)}}	
									</span>

									<span class="visible-lg">
										{{str_limit($deficiency->title, 35)}}
									</span>
								</a>					
							</td>

							<td class="visible-md visible-lg 
									visible-xl hidden-sm hidden-xs"
								data-toggle="tooltip"
								title="{{$deficiency->note}}">

								<span class="hidden-lg">
									{{ str_limit($deficiency->note, 20) }}
								</span>		

								<span class="visible-lg">
									{{ str_limit($deficiency->note, 30) }}
								</span>
							</td>	

							<td>
								<a href="{{Staff::find($deficiency->staff_id)
												->linkTo()}}">
									{{str_limit(Staff::find($deficiency->staff_id)
												->name(), 20)}}
								</a>
							</td>

							<td title="{{ Deficiency::find($deficiency->id)
													->postDateTime() }}" 
								data-toggle="tooltip">
								<span>{{ Deficiency::find($deficiency->id)
													->postDate() }}
								</span>
							</td>

							<td>
								@userInSameDepartment(Department::find($deficiency
																->department_id))
								{{ Form::open([
									'method' => 'PATCH',
									'route' => ['deficiency.update', 
												$deficiency->id],
									'style' => 'display: inline-block'
											])}}

								{{ Form::button('<span class="glyphicon 
												glyphicon-ok"></span>', 
												array('type' => 'submit', 
												'class' => 'btn btn-success
															btn-xs',
												'data-toggle' => 'tooltip',
												'title' => 'Mark as completed'
								)) }}	

								{{ Form::close() }}

								{{ Form::open([
									'method' => 'PATCH',
									'style' => 'display: inline-block',
									'route' => ['deficiency.update', 
												$deficiency->id]])}}

								{{ Form::button('<span class="glyphicon 
												glyphicon-edit"></span>', 
												array('type' => 'submit', 
												'class' => 'btn btn-success
															btn-xs',
												'data-toggle' => 'tooltip',
												'title' => 'Edit'
								)) }}	

							@enduserInSameDepartment
							</td>
						</tr>

					@endforeach

				</table>

				<div class="pagination-links pull-right">			
				{{ $deficiencies->appends(['sort' => $sort, 'order' => $order])
								->fragment('def')->links() }}
				</div>		
			</div>


	@endif
	</div>


@endsection
