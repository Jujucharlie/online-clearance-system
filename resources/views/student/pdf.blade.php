<html>
	<head>
		<title>{{$file_name}}</title>
	</head>

	<style>
		body{
			font-family: sans-serif; 
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
			width: 40%;
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

		.fillable-cell{
			border-bottom: 1px solid black;
			padding-left: 2%;
		}

		.spacer-cell{
			width: 5%;
		}


		.ocs-signature{
			font-size: 10pt;
			text-align: center;
		}

		.content{
			height: 50%;
			position: relative;
		}
		
		.loa-footer{
			font-size: 8pt;
			width: 100%;
			position: absolute;
			bottom: 0;
		}

		.loa-footer td{
			width: 33%;
			text-align: center;
		}

		.approved{
			float: right;
		}

		.signature-line{
			border-bottom: 1px solid black;
		}

		.deficiencies-count{
			text-align: center;
			padding: 50px;
		}
	</style>

	<body>
		<div class="content">
		<div class="header">
			COLLEGE OF ARTS AND SCIENCES<br/>
			University of the Philippines Manila<br/>
			STUDENT CLEARANCE
		</div>

			<table class="student-information">
				<tr>
					<td>
						NAME
					</td>
					<td class="student-name fillable-cell">
						{{ $student->name() }}
					</td>

					<td class="spacer-cell">
					</td>

					<td>
						Purpose
					</td>
					<td class="fillable-cell">
						{{ $student->purpose?$student->purpose:"n/a" }}
					</td>
				</tr>
				<tr>
					<td>
						Student No.
					</td>
					<td class="fillable-cell">
						{{ $student->student_number() }}
					</td>
				</tr>
				<tr>
					<td>
						Degree
					</td>
					<td class="fillable-cell">
						{{ $student->program->name }}
					</td>
				</tr>
			</table>

			<div class="deficiencies-count">
				@php
					$count = $student->incompleteDeficiencies()->count();
				@endphp

				@if(!$count)
					*** NO DEFICIENCIES ON RECORD ***
				@else
					*** {{$count==1 ? $count . " INCOMPLETE DEFICIENCY ": $count
						. "
					INCOMPLETE DEFICIENCIES "}} ON RECORD ***
				@endif

			</div>

			<div class="loa-footer">
				<table>
					<tr>
						<td class="approved">APPROVED:</td>
						<td class="signature-line"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>Dean / College Secretary</td>
						<td></td>
					</tr>

				</table>
				<hr>
				*Applicants for Leave of Absence must pay Leave of Absence Fee
				to Cash Division, U.P. Manila prior to the approval of the
				Dean/College Secretary.
			</div>
		</div>

		<div class="footer">
			<div class="date">
				{{-- Monday, January 10, 2020 9:23 AM --}}
				Generated on {{\Illuminate\Support\Carbon::now()->format('l, F
				j, Y h:i A')}} by {{ Auth::user()->name }}</div>
		</div>
	</body>
</html>
