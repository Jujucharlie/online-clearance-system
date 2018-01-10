<div class="header">
	<img class="upm-logo" src="{{asset('images/pdf/upm-logo.png')}}" />
</div>

<div class="content">
	<table center>
		<tr>
			<th>Name</th><td>{{$student->name()}}</td>

			<td><img src="{{$student->picture()}}" style="max-height:
			150"/></td>
		</tr>

		<tr>
			<th>Student Number</th><td>{{$student->student_number()}}</td>
		</tr>
		<tr>
			<th>College</th><td>{{$student->college()->name}}</td>
		</tr>
		<tr>
			<th>Program</th><td>{{$student->program->name}}</td>
		</tr>
	</table>
</div>


<div class="footer">
	Visit {{url($student->linkTo())}}
</div>

