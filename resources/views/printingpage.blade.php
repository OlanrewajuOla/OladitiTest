@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Course Allocation Application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <style type="text/css" media="screen">
 	#headline2 {
      background-image: url(code.jpg);
      background-repeat: no-repeat;
      background-position: left top;
      padding-top:68px;
   }
 	</style>
</style>
</head>
<body>

<div class="container">
	
  <h2 align="center">MOSHOOD ABIOLA POLYTECHNIC, ABEOKUTA</h2>
  <h3 align="center">COURSE ALLOCATION</h3	><br>
<?php

echo "<h4 align='right'>".date("Y-m-d H:i:s")."</h4>";
  ?>
 
  <h3 align="">DEPARTMENT:
  {{ Auth::user()->department}}</h3> 

           
  <table class="table table-bordered">
        <form method="POST" action="{{url('/deletedallocatedcourses')}}">
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
        @foreach ($nameoflecturers as $datas)

        <h3> Name&nbsp;:{{$datas->fullname}}</h3>
        <h3>Qualifications:&nbsp;{{$datas->Qualification}}</h3>
        <h3>Gender: {{$datas->gender}}</h3>



@endforeach

    			<table class="table">

    				<tr>
    					
    						
    					
    				</tr><br>

    				<tr>
    					
    					<th>course_code</th>
    					<th>course desciption</th>
    					<th>unit</th>
    					<th>level</th>					
    					<th>semester</th>					
              <th>stream</th>         
              <th>external department</th>         
    				</tr>

    	
    	@foreach ($courses as $datas)
    			<tr>
    					<td> {{$datas->course_code}}</td>
    					<td> {{$datas->course_title}}</td>
    					<td> {{$datas->course_unit}}</td>
    					<td> {{$datas->level}}</td>
    					<td> {{$datas->semester}}</td>
              <td> {{$datas->stream}}</td>
              <td> {{$datas->externaldepartment}}</td>
    					
    					
    					
    			</tr>
    			@endforeach
    			</table>
 
  
  

  </form>
  <input type="submit" name="" value="print" class="btn btn-primary btn-block hidden-print" onclick="window.print()"><br>
  <a href="{{url('/print')}}" class="hidden-print">Go BAck</a>

  
</div>

</body>
</html>



    </div>
</div>
@endsection