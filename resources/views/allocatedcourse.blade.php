@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row">



    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>work load for all semester</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <style type="text/css">
      @media print {
        @page { height: 90%;
    width: 1000%;}
  table{
    
  }
}
    </style>
    <style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  max-width: 1500px;
  
    
}

td {
  height: 50px;
  vertical-align: bottom;
}
</style>

    <body>

      <div class="container">
        <h2 style="font-style: bold;font-size: 210%;text-align: center;"><b>MOSHOOD ABIOLA POLYTECHNIC, ABEOKUTA</b></h2>
        <h4>WORK LOAD FOR FIRST AND SECOND SEMESTER</h4	>            
        <table style="width: 100%">
          <thead>
            <tr style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 20px;width: 20%">
              <th style="text-align: center;">S/N</th>
              <th style="text-align: center;">NAME</th>
              <th style="text-align: center;">CURRENT STATUE</th>
              <th style="text-align: center;">EXPECTED WORKLOAD</th>
              <th style="text-align: center;">COURSE(S) ALLOCATED WITH UNIT</th>
              <th style="text-align: center;">CLASSE(S) WHERE TAUGHT </th>
              

              <th style="text-align: center;">TOTAL UNIT</th>
              <th style="text-align: center;">REMARK</th>
              

            </tr>
          </thead>
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
          <?php $count=1 ?>
          @foreach ($data as $datas)
          <tbody>




             <!-- <tr>
              <td>  <input type="textbox"  name='data[{{$datas->id}}]' value='{{$datas->id}} '  ></td>
              <td> {{$datas->fullname}}</td>
              <td> {{$datas->cader}}</td>
              <td> {{$datas->Expectedworkload}}</td>
              <td> {{$datas->level}} {{$datas->department}} - {{$datas->course_unit}}</td>
              <td>{{$datas->level}}</td>


            </tr>  -->
             <tr>
              <td style="text-align: center; vertical-align: top; padding-top: 5px">{{ $count++ }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px">{{ $datas->fullname }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px">{{ $datas->cader }}</td>
              <td style="text-align: center; vertical-align: top; padding-top: 5px">{{ $datas->Expectedworkload }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px" >
                <?php 
                $total_unit = 0;
                $level_unit = 0;
                $department = \Auth::user()->department;
                $info = DB::select('SELECT * FROM allocated_courses WHERE department = "'.$department.'"');
                foreach ($info as $infos) {
                 if($datas->lecturers_id == $infos->lecturers_id){
                  ?>
                  <a href="{{ url('/allocatedDelete/'.$infos->id) }}" class=" hidden-print"><i class="fa fa-trash btn btn-danger"></i></a>
                  <?php
                  echo  $infos->course_code.' - '.$infos->course_unit.'<br>';
                  $total_unit += $infos->course_unit;



                  // if ($infos->level == $infos->level) {
                  //   $level_unit += $infos->course_unit;
                  // }
                 }

               }
               ?>
             </td>
             <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px">
               <?php
               $total_units=0;

               foreach ($info as $infoss) {
                 if($datas->lecturers_id == $infoss->lecturers_id){
                  echo $infoss->level.' - '.$infoss->externaldepartment.'&nbsp;&nbsp;'. $infoss->stream.' - ' . $infoss->course_unit.'<br>';
                  $total_units += $infoss->course_unit;



                  // if ($infos->level == $infos->level) {
                  //   $level_unit += $infos->course_unit;
                  // }
                 }
                 
               }

               ?>

             </td>

             
             <td style="text-align: center; vertical-align: top; padding-top: 5px">
               {{ $total_unit }}
             </td>

             <td style="text-align: center;vertical-align: top; padding-top: 4px;">
              <?php 
              $newdata = $datas->Expectedworkload + 5;
              ?>
               @if($total_unit > $newdata)
               {{ 'exceeded' }}
               @elseif ($total_unit == 0 )
               {{ ' ' }}
               @else{{ 'ok' }}
               @endif
             </td>
             
           </tr>



         </tbody>
         @endforeach
         <?php $count++ ?>

       </table>
       


     </form>
     <input type="submit" name="" value="print" class="btn btn-primary btn-block hidden-print" onclick="window.print()">
   </div>

 </body>
 </html>



</div>
</div>
@endsection