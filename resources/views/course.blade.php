
@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
  <div class="row col-sm-12">

    <div class="panel panel-default">

      <div class="panel-heading" align="center">

        <h2> Allocate Course</h2>  
        
        

      </div>
      <script type="text/javascript">
        function getddl(){
          document.getElementById('lblmess').innerHTML=(formid.lecturers_name[formid.lecturers_name.selectedIndex].value);

          //var x = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)

        }
        
      </script>
      <script type="text/javascript">
        $(function(){
          $('#select_id').on('change', function() {
            var id = $("select option:selected").data('id')
            var name = $("select option:selected").data('name')
           $('#id').val(id);
           $('#name').val(name);
            console.log(name)
          });


        });
      </script>
      <div class="panel panel-primary">
        <div class="panel-heading">Lecturers Details</div>
        <div class="panel-body">

          <label id="lblmess"></label>
        </div>
      </div>

      <form   method="POST" action="{{url('/allocate')}}" name="formid">
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

        <div class="panel-body" >

         <div class="col-sm-12">
          <!-- <h4>  Set Maximum unit </h4><input type="text" name="settotal"> -->
          <h3>Lecturers name</h3>      
          <select class="form-control" name="lecturers_name" onchange="getddl()" id="select_id">
            @foreach($lecturers_names as $lecturers_name)
            <option class="form-group" value="{{'Lecturers name:   '.$lecturers_name->fullname.'&nbsp;<br>'.'Expected work load:  '.$lecturers_name->Expectedworkload.'<br> Lecturers id:'.$lecturers_name->lecturers_id}}" data-id="{{ $lecturers_name->lecturers_id }}" data-name="{{ $lecturers_name->fullname }}"> {{$lecturers_name->fullname}} </option>
            @endforeach
          </select>


<input type="hidden" name="id" id="id" >
<input type="hidden" name="lecturer_name" id="name" >

          <div class="checkbox" id="catlist">
            <label>
              @foreach ($courses as $course)
              <input type="checkbox"  name="courses[{{$course->id}}]" value="{{$course->id}} " price="{{$course->course_unit}}" >

              <input type="text"  name="course_code[]" value="{{$course->course_code}}" style="width:75px;" readonly>

              <input type="text"  name="course_title[]" value="{{$course->course_title}}" style="width:350px;"readonly>

              <input type="text"  name="course_title[]" value="{{$course->course_unit}}" style="width:30px;"readonly>

              <input type="text" name="course_level[]" value="{{$course->level}}" style="width:50px;" readonly>
              <input type="text" name="course_level[]" value="{{$course->stream}}" style="width:50px;" readonly>
              <input type="text" name="course_level[]" value="{{$course->externaldepartment}}" style="width:340px;" readonly>

              <br><br>
              @endforeach



            </label>
          </div>Total Unit
          <input type="text" id="total" value="0"  readonly name="total_unit">

        </div>

      </br> <input type="submit" name="submit" class="btn btn-primary col-sm-12" >

    </form> 






  </div>

</div>













</div>
</div>
<!-- <script type="text/javascript">
  function test(a) {
    var x = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
    alert(x);
    
}
</script> -->


<script>


  function calcAndShowTotal() {
    var total = 0;
    
    $('#catlist :checkbox:checked').each(function() {
      total += parseFloat($(this).attr('price')) || 0;
    });
    $('#total').val(total);
  }

  $('#catlist :checkbox').change(calcAndShowTotal).change();

</script>


@endsection

