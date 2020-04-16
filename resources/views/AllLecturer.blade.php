@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary">

    		<div class="panel panel-heading">
    			<h3>All POST</h3>
    		</div>

    		@csrf

    		@if(Session::has('error'))

    		<div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
    		
    		@endif

    		@if(Session::has('Success'))

    		<div class="alert alert-success">
    			{{Session::get('Success')}}

    		</div>

    		@endif

    		<div class="panel panel-body">

    			<table class="table">

    				<tr>
    					<td>
    						<a href="{{url('/RegLecturer')}}" class="btn btn-primary">Create New Lecturer</a>
    					</td>
    				</tr>

    				<tr>
    					
    					<th>Fullname</th>
    					
    					<th>Department</th>
    					<th>Gender</th>
    					<th>DateofBirth</th>
    					<th>Address</th>
    					<th>Qualification</th>
    					<th>Experience</th>
                        <th>Cader</th>
                        <th>AreaofInterest</th>
                        <th>Expected workload</th>
    					<th>Delete</th>
    					<th>Edit</th>
    				</tr>
    			@foreach ($data as $datas)
    			<tr>
    					
    					<td> {{$datas->fullname}}</td>
    					<td> {{$datas->department}}</td>
    					<td> {{$datas->gender}}</td>
    					<td> {{$datas->dateofbirth}}</td>
    					<td> {{$datas->Address}}</td>
    					<td> {{$datas->Qualification}}</td>
    					<td> {{$datas->Experience}}</td>
                        <td> {{$datas->cader}}</td>
                        <td> {{$datas->AreaofInterest}}</td>
                        <td> {{$datas->Expectedworkload}}</td>
    					<td> <a href="{{url('deletelecturer/'.$datas->lecturers_id)}}"><i class="fa fa-trash btn btn-danger"></i></a></td>
    					<td> <a href="{{url('editlecturer/'.$datas->lecturers_id)}}"><i class="fa fa-edit btn btn-primary"></i></a></td>
    			</tr>
    			@endforeach
    			</table>
    			
    		</div>
    		
    	</div>

    </div>
</div>
@endsection
