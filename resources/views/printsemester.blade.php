@extends('layouts.app')

@section('content')
<div class="container">
    &nbsp;<div class="row">

    	<div class="panel panel-primary col-xs-8 col-xs-offset-1">
    		<div class="panel-heading">
    			SELECT SEMESTER
    		</div>
    		<div class="panel-body">
    			<form  action="{{url('/printingbysemester')}}" method="POST">
					@csrf
					<div class="form-group custome-select col-sm-8">

						<select class="form-control" name="semester" >
							<!-- @foreach($datasemester as $datasemesters)
							<option class="form-group" > {{$datasemesters->semester}} </option>
							@endforeach -->
							<option class="form-group" >FIRST SEMESTER</option>
							<option class="form-group" >SECOND SEMESTER</option>
						</select>

					</div>

					<button class="btn btn-default btn-sm">Submit</button>
				</form>	
    		</div>
    	</div>


    </div>
</div>
@endsection
