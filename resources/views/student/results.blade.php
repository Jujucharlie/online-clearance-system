@if($students->count() > 0)
<table>
	@foreach($students as $student)

		<tr>
			<td>
				<a href="{{$student->linkTo()}}">
					<img src="{{ $student->picture() }}" height="50px" /></a>
			</td>
			<td>{{ $student->name() }}</td>
			<td>{{ $student->email() }}</td>
			<td>{{ $student->student_number() }}</td>
			<td>{{ $student->program->name }}</td>
		</tr>

	@endforeach
</table>

@else
	No results found.
@endif
