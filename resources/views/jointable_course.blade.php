@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="panel panel-primary col-xs-6">
    		<div class="panel-heading">
    			UNALLOCATED COURSE
    		</div>
    		<div class="panel-body">
    			<table class="table table-bordered">
    				<tr>
    					<th>department</th>
    					<th>course code</th>
    					<th>course title</th>
    					<th>course unit</th>
    					<th>stream</th>
    					<th>level</th>
    					<th>External department</th>
    				</tr>
    				@foreach($data['table1'] as $datas)
    				<tr>
    					
    						
							<td>{{$datas->department}}</td>
							<td>{{$datas->course_code}}</td>
							<td>{{$datas->course_title}}</td>
							<td>{{$datas->course_unit}}</td>
							<td>{{$datas->stream}}</td>
							<td>{{$datas->level}}</td>
							<td>{{$datas->externaldepartment}}</td>
							
    					
    				</tr>
    				@endforeach
    			</table>
    		</div>
    	</div>
<div class="panel panel-primary col-md-6" >
    		<div class="panel-heading " style="text-align: right;">
    			ALLOCATED COURSE
    		</div>
    		<div class="panel-body">
    			<table class="table table-bordered">
    				<tr>
    					<th>department</th>
    					<th>course code</th>
    					<th>course title</th>
    					<th>course unit</th>
    					<th>stream</th>
    					<th>level</th>
    					<th>External department</th>
    				</tr>
    				@foreach($data['table2'] as $datas1)
    				<tr>
    					
    						
							<td>{{$datas1->department}}</td>
							<td>{{$datas1->course_code}}</td>
							<td>{{$datas1->course_title}}</td>
							<td>{{$datas1->course_unit}}</td>
							<td>{{$datas1->stream}}</td>
							<td>{{$datas1->level}}</td>
							<td>{{$datas1->externaldepartment}}</td>
							
    					
    				</tr>
    				@endforeach
    			</table>
    		</div>
    	</div>

    </div>
</div>
@endsection
