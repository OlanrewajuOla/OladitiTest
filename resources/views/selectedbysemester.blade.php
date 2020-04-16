@extends('layouts.app')

@section('content')



<div class="container">
  <div class="row">



    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>WORK LOAD </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
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
        <h3 style="text-align: center;">WORK LOAD FOR  
         {{$semester}} &nbsp;<?php  
        $date = date('Y')-1;
        $currentyear = date('Y');

        echo $date.'/'.$currentyear; ?>
        </h3><br><h4 style="text-transform: uppercase;">
        DEPARTMENT:  {{ Auth::user()->department}}</h4> NUMBER OF STREAMS:

  
  <table>
   
    
  @foreach ($streamselection as $streamselections) 
  <tr>
     
    
    
    {{$streamselections->level}} stream {{$streamselections->stream}},
   
 
 </tr>
  @endforeach 
  
    

  </table><br>
  
      

        <table style="width: 100%">
          <thead>
            <tr style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 20px;width: 20%">
              <th>S/N</th>
              <th style="text-align: center">NAME</th>
              <th style="text-align: center">CURRENT STATUE</th>
              <th style="text-align: center">EXPECTED WORKLOAD</th>
              <th style="text-align: center">COURSE(S) ALLOCATED WITH UNIT</th>
              <th style="text-align: center">CLASSE(S) WHERE TAUGHT </th>
              <th style="text-align: center" >TOTAL UNIT</th>
              <th style="text-align: center" >REMARK</th>
              

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
          @foreach ($select as $datas)
          <tbody>



            <tr>
              <td style="text-align: center; vertical-align: top; padding-top: 5px">{{ $count++ }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px">{{ $datas->fullname }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px">{{ $datas->cader }}</td>
              <td style="text-align: center; vertical-align: top; padding-top: 5px">{{ $datas->Expectedworkload }}</td>
              <td style="text-align: left; vertical-align: top; padding-top: 5px;padding-left: 10px" >
                <?php 
                $total_unit = 0;
                $level_unit = 0;
                
                foreach ($info as $infos) {
                 if($datas->lecturers_id == $infos->lecturers_id){
                  echo $infos->course_code.' - '.$infos->course_unit.'<br>';
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


                 }
                 
               }

               ?>

             </td>

             
             <td style="text-align: center; vertical-align: top; padding-top: 5px">
               {{ $total_unit }}
             </td>
              <td style="text-align: center; vertical-align: top;padding-top: 5px">
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
         

       </table>
       <!-- <input type="submit" name="submit" class="btn btn-primary col-sm-2" ><br><br> -->


     </form>
     <input type="submit" name="" value="print" class="btn btn-primary btn-block hidden-print" onclick="window.print()">
   </div>

 </body>
 </html>



</div>
</div>

@endsection
