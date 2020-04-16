@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel">

			<div class="panel-heading">
				<h3> Select Semesters</h3>
			</div>
			

			<div class="panel-body">
				<form  action="{{url('/selectsemester')}}" method="POST">
					@csrf
					<div class="form-group custome-select">

					<select class="form-control" name="semester" >
						<option value="" disabled selected>SELECT SEMESTER</option>
						<option value="FIRST SEMESTER">FIRST SEMESTER</option>
						<option value="SECOND SEMESTER">SECOND SEMESTER</option>
					</select>

					</div>

					<button class="btn btn-default btn-sm">Submit</button>
				</form>	
			</div>
		</div>

	</div>
</div>
@endsection
