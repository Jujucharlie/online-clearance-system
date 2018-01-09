
<div class="modal fade" id="edit-deficiency-{{$deficiency->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					Edit Deficiency Information
				</h3>
			</div>
				{{Form::open(['method' => 'PATCH',
						'route' => ['deficiency.edit',$deficiency->id]])}}

				{{ Form::token() }}
			<div class="modal-body">

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
