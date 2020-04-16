@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row"><br>

		<div class="panel panel-primary col-xs-8 col-xs-offset-1">
			<div class="panel-heading">Register Level and Streams</div>
			<div class="panel-body">
				<form action="{{url('/levelandstream')}}" method="POST">
					@csrf

					@if ($errors->any())
					<div class=" alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

					@if(Session::has('Success'))

					<div class="alert alert-success">
						{{Session::get('Success')}}

					</div>

					@endif

					
					@if(Session::has('error'))

					<div class="alert alert-danger">
						{{Session::get('error')}}

					</div>

					@endif
					<div class="col-xs-5">
						<div class="form-group has-feedback" >
							<label for="sel1">LEVEL</label>
							<select class="form-control"  name="level">
								<option> HND2</option>
								<option> HND1</option>
								<option>ND1</option>
								<option>ND2</option>
							</select>
							
						</div>
					</div>

					<div class="col-xs-5">
						<div class="form-group has-feedback" >
							<label for="sel1">Stream</label>
							<select class="form-control"  name="stream">
								<option>A </option>
								<option>B</option>
								<option>C</option>
								<option>D</option>
								<option>E</option>
								<option>F</option>
								<option>G</option>
								<option>H</option>
							</select>
							
						</div>
					</div>
					<input type="hidden" name="department" class="form-control" value="{{ Auth::user()->department}}" >
					<div class="col-sm-5">
						<input type="submit" name="submitlevel"  class="btn btn-primary">
						<input type="reset" name="reset" class="btn btn-danger">
					</div>

				</form>

			</div>
		</div>
	</div>
</div>
@endsection
