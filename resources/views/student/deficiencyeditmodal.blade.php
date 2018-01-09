
<div class="modal fade" id="edit-deficiency-{{$deficiency->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					Edit Deficiency Information
				</h3>
			</div>
				{{ Form::open([
					'method' => 'PATCH',
					'action' => ['DeficiencyController@update', 
								$deficiency->id],
					'style' => 'display: inline-block'
							])}}
				{{ Form::token() }}
			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', $deficiency->title,
						array("class" => "form-control")
					) }}
				</div>
				<div class="form-group">
					{{ Form::label('title', 'Note') }}
					{{ Form::textarea('note', $deficiency->note,
						array("class" => "form-control")
					) }}
				</div>
			</div>
			<div class="modal-footer">
				{{Form::button("Reset",
					array("type" => 'reset', 'class' => 'btn')
				)}}
				{{Form::button("Submit",
					array("type" => 'submit','class' => 'btn btn-success')
				)}}
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
