@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel">

			<div class="panel-heading">
				<h3> SELECT LECTURERS RECORD THAT YOU WANT TO PRINT</h3>
			</div>
			

			<div class="panel-body">
				<form  action="{{url('/printing')}}" method="POST">
					@csrf
					<div class="form-group custome-select col-sm-8">

						<select class="form-control" name="lecturers_name" >
							@foreach($data as $lecturers_name)
							<option class="form-group" > {{$lecturers_name->fullname}} </option>
							@endforeach
						</select>

					</div>

					<button class="btn btn-default btn-sm">Submit</button>
				</form>	
			</div>
		</div>

	</div>
</div>
@endsection
