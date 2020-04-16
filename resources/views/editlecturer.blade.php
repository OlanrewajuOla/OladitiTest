
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-sm-5">
			@foreach($data as $datas)
			<form action="{{url('/updatelecturer')}}" method="POST">

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

				<div class="form-group" >
					<label>Fullname</label>
					<input type="text" name="fullname" class="form-control" placeholder="Enter your Fullname" value="{{$datas->fullname}}">
				</div>

				<div class="form-group" >
					<label>Email</label>
					<input type="Email" name="Email" class="form-control" placeholder="Enter your Email" value="{{$datas->Email}}">
				</div>

				<input type="hidden" name="department" class="form-control" value="{{ Auth::user()->department}}">

				<input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Female">Female<br><br>
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="date" name="dateofbirth" class="form-control" value="{{$datas->dateofbirth}}">
				</div>

				<div class="form-group" >
					<label>Address</label>
					<input type="text" name="Address" class="form-control" value="{{$datas->Address}}" placeholder="Enter Your Address">
				</div>

				<div class="form-group" >
					<label>Academic Qualification</label>
					<input type="text" name="Qualification" class="form-control" placeholder="Enter Your Academic Qualification" value="{{$datas->Qualification}}">
				</div>
				<input type="hidden" name="lecturers_id" class="form-control"  value="{{$datas->lecturers_id}}">

				<div class="form-group" >
					<label>Teaching Experience</label>
					<input type="number" name="Experience" class="form-control" placeholder="Years of Teaching Experience" value="{{$datas->Experience}}">
				</div>

				<div class="form-group has-feedback" >
                  <label for="sel1">Lecturers Cader</label>
                  <select class="form-control"  name="cader">
                  	<option>{{$datas->cader}}</option>
                    <option> Associate Lecturer</option>
                    <option> Lecturer III</option>
                    <option>Lecturer II</option>
                    <option>Lecturer I</option>
                    <option>Senior Lecturer</option>
                    <option>Principal Lecturer</option>
                    <option>Chief Lecturer</option>
                </select>
                
            </div>


				<div class="form-group" >
					<label>Expected Workload</label>
					<input type="number" name="Expectedworkload" class="form-control" placeholder="Expected Workload" value="{{$datas->Expectedworkload}}">
				</div>
				

            
				<div class="form-group" >
					<label>Area of Interest</label>
					
					<textarea class="form-control" name="AreaofInterest">{{$datas->AreaofInterest}}</textarea>
				</div>
				



				<input type="submit" name="submit"  class="btn btn-primary">
				<input type="reset" name="reset" class="btn btn-danger">

			</form>
			@endforeach
		</div>

	</div>
</div>
@endsection
