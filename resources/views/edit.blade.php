


    	@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row ">

		<div class="panel panel-default">
			<div class="panel-heading" align="center">
				<h2> Edit / Update Course</h2>
				<p>{{ Auth::user()->department}}</p>
				
			</div>
			<button class="btn btn-primary"><a href="{{url('AllCourse')}}"><i class="fa fa-backward btn btn-primary"></i></a></button>
		

		
			@foreach($data as $datas)
			<form class="form-horizontal" action="{{url('/updatecourse')}}" method="POST">
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
				

				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Course Code</label>
					<div class="col-sm-6">
						<input type="text" name="course_code"class="form-control"  placeholder="Enter Course Code e.g com 111" value="{{$datas->course_code}}">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" >Course title</label>
					<div class="col-sm-6">
						<input type="text" name= "course_title"  value="{{$datas->course_title}}"class="form-control"  placeholder="Enter Course Code e.g intro to computing" onkeyup="Validate()" id="course_title">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Course Unit</label>
					<div class="col-sm-2">
						<input type="number" name="course_unit" class="form-control"  placeholder="Enter Course unit" value="{{$datas->course_unit}}">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Select level</label>
					<div class="col-sm-6">
						<select class="form-control" id="sel1" name="level">
							<option> {{$datas->level}}</option>
							<option> ND1</option>
							<option> ND2</option>
							<option>HND1</option>
							<option>HND2</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Select Stream</label>
					<div class="col-sm-6">
						<select class="form-control" id="sel1" name="stream">
							<option>{{$datas->stream}}</option>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
							<option>E</option>
							
							
							
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Select Semester</label>
					<div class="col-sm-6">
						<select class="form-control" id="sel1" name="semester" value="{{$datas->semester}}">
							<option>{{$datas->semester}}</option>
							<option>FIRST SEMESTER</option>
							<option>SECOND SEMESTER</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<input type="hidden" name="department"class="form-control" value="{{ Auth::user()->department}}">					
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">External department</label>
					<div class="col-sm-6">
						<select class="form-control" id="sel1" name="externaldepartment">
							<option>{{$datas->externaldepartment}}</option>
							<option></option>
							<option>mass communication</option>
							<option>business adminstrator</option>
						</select>
					</div>
				</div>

				
						<input type="hidden" name="id" value="{{$datas->id}}">
					

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" name="submit" class="btn btn-primary"> 
					</div>
				</div>
			</form>
			@endforeach

		</div>
	</div>
</div>
</div>

@endsection



    
