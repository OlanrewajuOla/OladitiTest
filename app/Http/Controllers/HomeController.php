<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Connectors\Connector;
//use App\Http\Controllers\PDO;
use PDO;
use Session;
use App\Courses;
use App\lecturers;
use App\allocated_course;
use App\allocated;
use App\levelandstream;
use App\Stream;
use DB;
use mysqli;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('home');
    }
    public function RegisterLevel()
    {
      return view('RegisterLevel');
    }

    public function printsemester()
    {

      $department = \Auth::user()->department;

      $datasemester = allocated_course::where('department',$department)->get();

  // return view('print',compact('data'));
      return view('printsemester',compact('datasemester'));
    }


    // this is for Semester Page function

    public function semester()
    {

     return view ('semester');

   } 
   public function printingpage(Request $request){
      // --------- 
    $lecturers_name = Session::get('lecturers_name');
    $department = \Auth::user()->department;
    //$courses=lecturers::where('fullname',$lecturers_name)->
    //where('department',$department)->get();

    $courses = DB::select('SELECT * FROM lecturers,allocated_courses WHERE lecturers.lecturers_id = allocated_courses.lecturers_id AND allocated_courses.department ="'.$department.'" AND lecturers.fullname  = "'.$lecturers_name.'" ');

    $nameoflecturers = DB::select('SELECT fullname, gender,Qualification FROM lecturers WHERE fullname = "'.$lecturers_name.'" ');

    
    return view('printingpage',compact('courses','nameoflecturers'));
  }

  public function selectedbysemester(Request $request)
  {
    $semester = Session::get('semester');
    $department = \Auth::user()->department;
   // $select =DB::select('SELECT * FROM lecturers,allocated_courses WHERE lecturers.lecturers_id = allocated_courses.lecturers_id AND allocated_courses.department = "'.$department.'" AND allocated_courses.semester="'.$semester.'"');
    $select = lecturers::where('department', $department)->get();
    $info = DB::select('SELECT * FROM allocated_courses WHERE semester = "'.$semester.'" AND department = "'.$department.'"');
      // $streamselection =DB::select('SELECT COUNT(`level`) FROM `levelandstreams` WHERE `level` = "nd2" AND department = "computer science"');
    $streamselection = DB::select('SELECT DISTINCT level,stream FROM levelandstreams WHERE department ="'.$department.'" ORDER BY level');
   // $streamselectionz = DB::select('SELECT COUNT(`level`) FROM `levelandstreams` WHERE `level` = "hnd2"');

    return view('selectedbysemester',compact('select','info','semester','streamselection'));
  } 

  public function allocatedcourse()
  {

   $department = \Auth::user()->department;

    //$data=allocated_course::where('department',$department)->get();
    //$data=DB::table('lecturers')->join('allocated_courses','lecturers.lecturers_id','=','allocated_course.lecturers_id')->get();
   $data = lecturers::where('department', $department)->get();

  // $data = DB::select('SELECT * FROM lecturers,allocated_courses WHERE lecturers.lecturers_id = allocated_courses.lecturers_id AND allocated_courses.department ="'.$department.'"');

   return view('allocatedcourse',compact('data'));


 }

 public function edit($id){
  $data = Courses::where('id',$id)->get();
  return view('edit')->with('data',$data);

}
public function editlecturer($lecturers_id){
  $data = lecturers::where('lecturers_id',$lecturers_id)->get();
  return view('editlecturer')->with('data',$data);
}


public function RegCourse(){

  return view('RegCourse');

}

public function RegLecturer(){


  $department = \Auth::user()->department;

  $courses=lecturers::where('department',$department)->paginate(10);
  return view('RegLecturer')->with('courses',$courses);

}

public function updatelecturer(Request $request){

  if (isset($_POST['submit'])) {

    $request->validate([
      'fullname'=> 'required',
      'Email' => 'required',
      'department' => 'required',
      'gender' => 'required',
      'dateofbirth' => 'required',
      'Address' => 'required',
      'Qualification' => 'required',
      'Experience' => 'required',
      'cader' => 'required',
      'Expectedworkload' => 'required',
      'AreaofInterest' => 'required'

    ]);

    if ($request['Experience']<0) {
      Session::flash('error','Years of Experience cannot be less than zero');
      return redirect('AllLecturer');
    }
    else if (!preg_match("/^[a-z A-z 0-9]*$/", $request['Address'])) {
      Session::flash('error','Address must not contain special Character');
      return redirect('AllLecturer');
    }
    else if (!preg_match("/^[a-z A-z 0-9]*$/", $request['AreaofInterest'])) {
      Session::flash('error','Area of interest must not contain special Character');
      return redirect('AllLecturer');
    }
    else {

      lecturers::where('lecturers_id',$request['lecturers_id'])->update([
        'fullname'=>$request['fullname'],
        'Email'=>$request['Email'],
        'department'=>$request['department'],
        'gender'=>$request['gender'],
        'dateofbirth'=>$request['dateofbirth'],
        'Address'=>$request['Address'],
        'Qualification'=>$request['Qualification'],
        'Experience'=>$request['Experience'],
        'cader'=>$request['cader'],
        'Expectedworkload'=>$request['Expectedworkload'],
        'AreaofInterest'=>$request['AreaofInterest']

      ]);

      Session::flash('Success','Record Updated succesfully');
      return redirect('AllLecturer');

    }



  }

}



  // this is for deletint

public function delete($id){

  Courses::where('id',$id)->delete();
  Session::flash('error','Record Deleted Successfully');
  return redirect('AllCourse');

}

public function deletelecturer($lecturers_id){

  lecturers::where('lecturers_id',$lecturers_id)->delete();
  allocated_course::where('lecturers_id',$lecturers_id)->delete();
  Session::flash('error','Record Deleted Successfully');
  return redirect('AllLecturer');

}

//SELECT *
//FROM assigned_courses
//INNER JOIN courses ON Orders.CustomerID=Customers.CustomerID;


// this show all the course in the department
public function AllCourse(){

  $department = \Auth::user()->department;

  $data=Courses::where('department',$department)->get();
   // $data = DB::select('SELECT * FROM Courses,allocated_courses WHERE lecturers.lecturers_id = allocated_courses.lecturers_id AND allocated_courses.department ="'.$department.'"');

    //$data = Courses::all();
  return view('AllCourse')->with('data',$data);

}

public function selectsemester(Request $request)
{

  $semester = $request['semester'];
  Session::put('semester',$semester);
  return redirect('course');
}

public function printing(Request $request){

  $lecturers_name = $request['lecturers_name'];
  Session::put('lecturers_name',$lecturers_name);
  return redirect('printingpage');

}
//printingbysemester
public function printingbysemester(Request $request){

  $semester = $request['semester'];
  Session::put('semester',$semester);
  /*return redirect('printingpage');*/
  return redirect('selectedbysemester');

}

  // Output All Lecturer
public function AllLecturer(){
  $department = \Auth::user()->department;

  $data=lecturers::where('department',$department)->get();

  return view('AllLecturer')->with('data',$data);

}


public function submitlecturer(Request $request){

  if (isset($_POST['submit'])) {

    $request->validate([
      'fullname'=> 'required',
      'Email' => 'required|unique:lecturers',
      'department' => 'required',
      'gender' => 'required',
      'dateofbirth' => 'required',
      'Address' => 'required',
      'Qualification' => 'required',
      'Experience' => 'required',
      'cader'=>'required',
      'Expectedworkload'=>'required',
      'AreaofInterest'=>'required',

    ]);

    if ($request['Experience']<0 || $request['Expectedworkload']<0) {
      Session::flash('error','Years of Experience and Expected workload cannot be less than zero ');
      return redirect('RegLecturer');
    }
    else if (!preg_match("/^[a-z A-z]*$/", $request['Address'])) {
      Session::flash('error','must not contain special Character');
      return redirect('RegLecturer');
    }
    else if (!preg_match("/^[a-z A-z]*$/", $request['AreaofInterest'])) {
      Session::flash('error','must not contain special Character');
      return redirect('RegLecturer');
    }
    else {

      lecturers::create([
        'fullname'=>$request['fullname'],
        'Email'=>$request['Email'],
        'department'=>$request['department'],
        'gender'=>$request['gender'],
        'dateofbirth'=>$request['dateofbirth'],
        'Address'=>$request['Address'],
        'Qualification'=>$request['Qualification'],
        'Experience'=>$request['Experience'],
        'cader'=>$request['cader'],
        'Expectedworkload'=>$request['Expectedworkload'],
        'AreaofInterest'=>$request['AreaofInterest']

      ]);

      Session::flash('Success','Submitted succesfully');
      return redirect('RegLecturer');

    }



  }
}

public function levelandstream(Request $request){
  $request->validate([
    'level'=>'required',
    'stream'=>'required',
  ]);
  $exist = levelandstream::where('level', $request['level'])
  ->where('stream', $request['stream'])->where('department',$request['department'])->get();

  if ($exist->isEmpty()) 
  {

   $noOfStream = Stream::where('department', $request['department'])
   ->where('level', $request['level'])->first();
   $newno = $noOfStream->total_stream + 1;
   Stream::where('department', $request['department'])
   ->where('level', $request['level'])
   ->update([
    'total_stream' => $newno,
   ]);

   levelandstream::create([
    'level'=>$request['level'],
    'stream'=>$request['stream'],
    'department'=>$request['department']
  ]);
   Session::flash('Success','Submitted succesfully');
 }
 else{
   Session::flash('error','Stream already registered'); 
 }
 return redirect('RegisterLevel');
}

// this function is to add course to database
public function submitcourse(Request $request){
  if (isset($_POST['submit'])) {
  # code...

    $request->validate([
      'course_code'=> 'required',
      'course_title' => 'required',
      'course_unit' => 'required',
      'level' => 'required',
      'semester' => 'required',
      'department' => 'required',
      


    ]);
    if ($request['course_unit']<0) {
      Session::flash('error','A Unit Cannot be more less than zero');
      return redirect('RegCourse');
    }
    elseif (!preg_match("/^[a-z A-z]*$/", $request['course_title']) || !preg_match("/^[0-9]*$/", $request['course_unit'])) {
      Session::flash('error','Must not contain a special character or space');
      return redirect('RegCourse');
    }
    else{
      $exist = Courses::where('department',$request['department'])->where('level',$request['level'])->where('semester',$request['semester'])->where('course_title',$request['course_title'])->where('course_code',$request['course_code'])->where('course_unit',$request['course_unit'])->where('stream',$request['stream'])->where('externaldepartment',$request['externaldepartment'])->get();

      $exist2 = allocated_course::where('department',$request['department'])->where('level',$request['level'])->where('semester',$request['semester'])->where('course_title',$request['course_title'])->where('course_code',$request['course_code'])->where('course_unit',$request['course_unit'])->where('stream',$request['stream'])->where('externaldepartment',$request['externaldepartment'])->get();

      if ($exist->isEmpty() && $exist2->isEmpty()) {
        Courses::create([
          'department'=>$request['department'],
          'level'=>$request['level'],
          'semester'=>$request['semester'],
          'course_title'=>$request['course_title'],
          'course_code'=>$request['course_code'],
          'course_unit'=>$request['course_unit'],
          'stream'=>$request['stream'],
          'externaldepartment'=>$request['externaldepartment'],
        ]);

        Session::flash('Success','Submitted succesfully');
        
      }
      else{
        Session::flash('error','Record All Ready exist in the database');
      }

      
      return redirect('RegCourse');
    }
  }
}


  // This is for Update Course

public function updatecourse(Request $request){

  if (isset($_POST['submit'])) {
  # code...

    $request->validate([
      'course_code'=> 'required',
      'course_title' => 'required',
      'course_unit' => 'required',
      'level' => 'required',
      'semester' => 'required',
      'department' => 'required'

    ]);
    if ($request['course_unit']<0) {
      Session::flash('error','A Unit Cannot be more less than zero');
      return redirect('RegCourse');
    }
    elseif (!preg_match("/^[a-z A-z]*$/", $request['course_title']) || !preg_match("/^[0-9]*$/", $request['course_unit'])) {
      Session::flash('error','Must not contain a special character or space');
      return redirect('RegCourse');
    }
    else{



      Courses::where('id',$request['id'])->update([
        'department'=>$request['department'],
        'level'=>$request['level'],
        'semester'=>$request['semester'],
        'course_title'=>$request['course_title'],
        'course_code'=>$request['course_code'],
        'course_unit'=>$request['course_unit'],
        'stream'=>$request['stream'],
        'externaldepartment'=>$request['externaldepartment'],
      ]);

      Session::flash('Success','Course Updated Succesfully');
      return redirect('AllCourse');
    }
  }


}


public function course(){

  $semester = Session::get('semester');
  $department = \Auth::user()->department;

  $courses=Courses::where('semester',$semester)->
  where('department',$department)->get();

  $lecturers_names=lecturers::where('department',$department)->get();
  return view('course',compact('courses','lecturers_names'));
}

public function print(){

  $department = \Auth::user()->department;

    // $data = DB::select('SELECT * FROM lecturers,allocated_courses WHERE lecturers.lecturers_id = allocated_courses.lecturers_id AND allocated_courses.department ="'.$department.'" ');
  $data = lecturers::where('department',$department)->get();

  return view('print',compact('data'));
}

  //deletedallocatedcourses

public function deletedallocatedcourses(Request $request){


  $request->validate([
    'removeallocatedcourse'=> 'required',
  ]);

  foreach ($request->removeallocatedcourse as $removecourse) {
    $allocated = allocated_course::find($removecourse);
      //dd($allocated);

    $allocatedcourseId = $removecourse['id'];
    $lecturers = $removecourse['lecturers_id'];
    $courses_id = $removecourse['course_id'];
    $department = $removecourse['department'];
    $level = $removecourse['level'];
    $semester = $removecourse['semester'];
    $course_title = $removecourse['course_title'];
    $course_code = $removecourse['course_code'];
    $course_unit = $removecourse['course_unit'];
    $stream = $removecourse['stream'];
    $externaldepartment = $removecourse['externaldepartment'];

    Courses::create([
      'id'=>$courses_id,
      'department'=>$department,
      'level'=>$level,
      'semester'=>$semester,
      'course_title'=>$course_title,
      'course_code'=>$course_code,
      'course_unit'=>$course_unit,
      'stream'=>$stream,
      'externaldepartment'=>$externaldepartment,
    ]);

    allocated_course::where([
      'id'=>$allocatedcourseId,
      'lecturers_id'=>$lecturers,
      'course_id'=>$courses_id,
      'department'=>$department,
      'level'=>$level,
      'semester'=>$semester,
      'course_title'=>$course_title,
      'course_code'=>$course_code,
      'course_unit'=>$course_unit,
      'stream'=>$stream,
      'externaldepartment'=>$externaldepartment,
    ])->delete();

  }
  Session::flash('Success','Course Removed');
  return redirect('allocatedcourse');

}



public function allocate(Request $request){

//return $request;
  if(isset($_POST['submit'])){
   // $settotal = $_POST['settotal'];
    $total_unit = $_POST['total_unit'];
   //  if ($total_unit>$settotal ) {
   //   Session::flash('error','Maximum unit Exceeded');
   //   return redirect('course');
   // }
   //else{
    $request->validate([
      'lecturers_name'=> 'required',
      'lecturer_name'=> 'required',
      'courses'=> 'required',
    ]);

      // $datas = explode('|', $_POST['lecturers_name']);
      // $lecturers_id = $datas[0];
      // $lecturers_name = $datas[1];
      // //dd($lecturers_id);




    foreach($request->courses as $courseId){

      $course = Courses::find($courseId);

      $courses_id = $course['id'];

      $department = $course['department'];

      $level = $course['level'];

      $semester = $course['semester'];

      $course_title = $course['course_title'];

      $course_code = $course['course_code'];

      $unit = $course['course_unit'];

      $stream = $course['stream'];

      $externaldepartment = $course['externaldepartment'];



      allocated_course::create([
        'lecturers_id'=>$request['id'],
        'course_id'=>$courses_id,
        'department'=>$department,
        'level'=>$level,
        'semester'=>$semester,
        'course_title'=>$course_title,
        'course_code'=>$course_code,
        'course_unit'=>$unit,
        'stream'=>$stream,
        'externaldepartment'=>$externaldepartment,
      ]);

      Courses::where([
        'id'=>$courses_id,
        'department'=>$department,
        'level'=>$level,
        'semester'=>$semester,
        'course_title'=>$course_title,
        'course_code'=>$course_code,
        'course_unit'=>$unit,
        'stream'=>$stream,
        'externaldepartment'=>$externaldepartment,
      ])->delete();


    }
    Session::flash('Success','Course Allocated Succesfully');
    return redirect('course');

  //}
}
}

public function allocatedDelete($allocated_id)
{
  $info = allocated_course::where('id', $allocated_id)->first();
  #
  #returning the course allocated back to course table
  courses::create([
    'department' => $info->department,
    'level' => $info->level,
    'semester' => $info->semester,
    'course_title' => $info->course_title,
    'course_code' => $info->course_code,
    'course_unit' => $info->course_unit,
    'stream' => $info->stream,
    'externaldepartment' => $info->externaldepartment,
  ]);
  #deleting the course allocated from course table
  allocated_course::where('id', $allocated_id)->delete();
  Session::flash('error','Course Allocated deleted Succesfully');
    return redirect('allocatedcourse');
}


public function jointable_course()
{
  $department = \Auth::user()->department;

  $data['table1'] = courses::where('department',$department)->get();
  $data['table2'] = allocated_course::all();
 //return $data;

  return view('jointable_course',compact('data'));
}























}
