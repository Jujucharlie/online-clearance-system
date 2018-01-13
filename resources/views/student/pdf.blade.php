<html>
	<head>
		<title>{{$file_name}}</title>
	</head>

	<style>
		body{
			font-family: serif; 
			font-size: 10pt;
		}

		.header{
			text-align: center;
			font-size: 12pt;
		}
		.footer{
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			text-align: right;
		}

		table{
			text-align: left;
			width: 100%;
			padding-top: 40px;
		}

		.student-name{
			text-transform: uppercase;
			font-weight: bold;
		}

		.date{
			font-size: 8px;
			font-style: italic;
		}

		.def-table-header td{
			font-size: 10px;
			font-weight: bold;
		}

		.def-table-info td{
			font-weight: normal;
			padding-top: 20px;
		}

		.def-count{
			text-align: center;
		}
	</style>

	<body>
		<div class="header">
			University of the Philippines Manila<br/>
			College of Arts and Sciences<br/>
			<br/>
			COLLEGE CLEARANCE
		</div>

		<div class="content">
			<table class="student-information">
				<tr>
					<td>Name</td>
					<td class="student-name">{{$student->name()}}</td>
				</tr>
				<tr>
					<td>Student Number</td>
					<td>{{$student->student_number()}}</td>
				</tr>
				<tr>
					<td>Program</td>
					<td>{{$student->program->name}}</td>
				</tr>
				<tr>
					<td>College</td>
					<td>{{$student->college()->name}}</td>
				</tr>
			</table>

			<table>
				<tr class="def-table-header">
					<th>Department</th>
					<th>Deficiencies</th>
				</tr>
				@foreach(College::whereShortName('cas')->first()
					->departments->sortBy('short_name') as $department)
						<tr class="def-table-info">
							<td>{{$department->name}}</td>
							<td class="def-count">
								{{$student->incompleteDeficiencies()
								->where('department_id', $department->id)
								->count()}}
							</td>
						</tr>
				@endforeach
			</table>
		</div>

		<div class="footer">
			<div class="date">
				{{-- Monday, January 10, 2020 9:23 AM --}}
				Generated on {{\Illuminate\Support\Carbon::now()->format('l, F
			j, Y h:i A')}}</div>
		</div>
	</body>
</html>
