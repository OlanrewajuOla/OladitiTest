@extends('layouts.app')

@section('content')
<div class="container "><br>
    <div class="row col-sm-12">

    	<div class="panel panel-primary col-sm-12">

    		<div class="panel panel-heading">
    			<h3 class="">ALL UNALLOCATED COURSES</h3>
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
    						<a href="{{url('/RegCourse')}}" class="btn btn-primary">Create Message</a>
    					</td>
    				</tr>

    				<tr>
    					<th>id</th>
    					<th>Department</th>
    					<th>Level</th>
    					<th>semester</th>
    					<th>course_title</th>
    					<th>course_code</th>
    					<th>course_unit</th>
                        <th>External Department</th>
                        <th>Stream</th>
    					<th>Delete</th>
    					<th>Edit</th>
    				</tr>
    			@foreach ($data as $datas)
    			<tr>
    					<td> {{$datas->id}}</td>
    					<td> {{$datas->department}}</td>
    					<td> {{$datas->level}}</td>
    					<td> {{$datas->semester}}</td>
    					<td> {{$datas->course_title}}</td>
    					<td> {{$datas->course_code}}</td>
    					<td> {{$datas->course_unit}}</td>
                        <td> {{$datas->externaldepartment}}</td>
                        <td> {{$datas->stream}}</td>
    					<td> <a href="{{url('delete/'.$datas->id)}}"><i class="fa fa-trash btn btn-danger"></i></a></td>
    					<td> <a href="{{url('edit/'.$datas->id)}}"><i class="fa fa-edit btn btn-primary"></i></a></td>
    			</tr>
    			@endforeach
    			</table>
    			
    		</div>
    		
    	</div>

    </div>
</div>
@endsection
