
{{ Form::open([
	'method' => 'PATCH',
	'action' => ['DeficiencyController@complete', 
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

<button class="btn btn-xs btn-info"
		type="button"
		data-toggle="modal"
	  data-target="#edit-deficiency-{{$deficiency->id}}">
	<span class="glyphicon
	glyphicon-edit"></span>
</button>
@include('student.editmodal')
