@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-body col-sm-7">

		<div>
			<form action="{{url('/submitlecturer')}}" method="POST">

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

				<div class="col-sm-5">
				<div class="form-group" >
					<label>Fullname</label>
					<input type="text" name="fullname" class="form-control" placeholder="Enter your Fullname">
				</div>
				</div>
				<div class="col-sm-5">
				<div class="form-group" >
					<label>Email</label>
					<input type="Email" name="Email" class="form-control" placeholder="Enter your Email">
				</div>
				</div>

				<input type="hidden" name="department" class="form-control" value="{{ Auth::user()->department}}">
				<div class="col-sm-5">
				<input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Female">Female<br><br>
				</div>

				<div class="col-sm-5">
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="date" name="dateofbirth" class="form-control">
				</div>
				</div>

				<div class="col-sm-5">
				<div class="form-group" >
					<label>Address</label>
					<input type="text" name="Address" class="form-control" placeholder="Enter Your Address">
				</div>
				</div>

				<div class="col-sm-5">
				<div class="form-group" >
					<label>Academic Qualification</label>
					<input type="text" name="Qualification" class="form-control" placeholder="Enter Your Academic Qualification">
				</div>
				</div>

				<div class="col-sm-5">
				<div class="form-group" >
					<label>Teaching Experience</label>
					<input type="number" name="Experience" class="form-control" placeholder="Years of Teaching Experience">
				</div>
				</div>


				<div class="col-sm-5">
				<div class="form-group has-feedback" >
                  <label for="sel1">Lecturers Cader</label>
                  <select class="form-control"  name="cader">
                    <option> Associate Lecturer</option>
                    <option> Lecturer III</option>
                    <option>Lecturer II</option>
                    <option>Lecturer I</option>
                    <option>Senior Lecturer</option>
                    <option>Principal Lecturer</option>
                    <option>Chief Lecturer</option>
                </select>
                
            </div>
            </div>

            <div class="col-sm-10">
				<div class="form-group" >
					<label>Expected Workload</label>
					<input type="number" name="Expectedworkload" class="form-control" placeholder="Expected Workload">
				</div>
				</div>

            <div class="col-sm-10">
				<div class="form-group" >
					<label>Area of Interest</label>
					
					<textarea class="form-control" name="AreaofInterest">  

					</textarea>
				</div>
				</div>

            	<div class="col-sm-5">
				<input type="submit" name="submit"  class="btn btn-primary">
				<input type="reset" name="reset" class="btn btn-danger">
				</div>

			</form>
		</div>
		

	</div>
	<div class="panel panel-primary col-sm-5">

    		<div class="panel panel-heading">
    			<h3>All lecturers</h3>
    		</div>
    		<table class="table table-bordered">
    			<tr> 
    				<th> Lecturers name</th>
    				<th> Cader</th>
    				<th> Expected WorkLoad</th>
    			</tr>

    		<div class="panel panel-body">
    			@foreach($courses as $course)

    			<tr>
    				<td>{{$course->fullname}} </td>
    				<td>{{$course->cader}} </td>
    				<td>{{$course->Expectedworkload}} </td>
    			</tr>
    			

    			@endforeach

    			
    		</div>
    		</table>
    		{{ $courses->links() }}
    </div>
	</div>
</div>
@endsection
