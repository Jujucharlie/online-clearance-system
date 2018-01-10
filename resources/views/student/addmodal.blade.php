
@hasRole("staff")
	<div class="container-fluid">
		<button class="btn btn-danger pull-right"
				data-toggle="modal"
				data-target="#add-deficiency-modal"
			>
			<span class="glyphicon glyphicon-plus"></span>
			Add item
		</button>
	</div>
@php
	$staff = Staff::whereUserId(Auth::user()->id)->firstOrFail();
	$department = $staff->department;
@endphp
<div class="modal fade container" id="add-deficiency-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add Item</h3>
			</div>
				{{ Form::open([
					'method' => 'POST',
					'action' => ['DeficiencyController@store'],
					'style' => 'display: inline-block'])}}

				{{ Form::token() }}

			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('student', 'Student') }}
					{{ Form::text('student',
						$student->name(),
						array("class" => "form-control", "readonly")
					) }}
				</div>

				<div class="form-group">
					{{ Form::label('department', 'Department') }}
					{{ Form::text('department', $department->name,
						array("class" => "form-control", "readonly")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('staff_id', 'Staff') }}
					{{ Form::text('staff_id', $staff->name(),
						array("class" => "form-control", "readonly")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', null,
						array("class" => "form-control", 
							"autocomplete" => "off",
							"placeholder" => "Title",
							"required", "autofocus")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('title', 'Note') }}
					{{ Form::textarea('note', null,
						array("class" => "form-control",
							  "placeholder" => "Additional information"
						)
					) }}
				</div>
			</div>
			<div class="modal-footer">
				{{Form::button("Reset",
					array("type" => "reset", "class" => "btn")
				)}}
				{{Form::button("Submit",
					array("type" => "submit",
						"class" => "btn btn-success",
						"title" => "Submitting notifies the student via email",
						"data-toggle" => "tooltip"
					)
				)}}


				{{ Form::hidden("student_id", $student->student_number)}}
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

@endhasRole	
