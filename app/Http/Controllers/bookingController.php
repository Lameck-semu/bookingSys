<?php

namespace App\Http\Controllers;
use Charts;
use App\Mail\Success;
use App\Mail\Success_Public;
use App\Mail\Failure_Public;
use App\Mail\Failure;
use Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User as User;
use App\reject as reject;
use App\bedspace as bedspace;
use App\programmes as programmes;
use App\department as department;
use App\ResetStudents as ResetStudents;
use App\ResetPublic as ResetPublic;
use App\facility_booking_student as facility_booking_student;
use Illuminate\Http\Request;
use App\facility_booking_public as facility_booking_public;
use App\facility as facility;
use App\Imports\StudentImport;
use App\Imports\ProgrammeImport;
use App\Imports\BedspaceImport;
use Maatwebsite\Excel\Facades\Excel;

class bookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct(User $User, facility_booking_student $facility_booking_student, ResetStudents $ResetStudents, facility_booking_public $facility_booking_public, facility $facility, reject $reject, programmes $programmes, ResetPublic $ResetPublic, department $department, bedspace $bedspace){
        $this-> User = $User;
        $this-> reject = $reject;
        $this-> facility_booking_student = $facility_booking_student;
        $this-> ResetStudents = $ResetStudents;
        $this-> ResetPublic = $ResetPublic;
        $this-> facility_booking_public = $facility_booking_public;
        $this-> facility = $facility;
        $this-> programmes = $programmes;
        $this-> department = $department;
        $this-> bedspace = $bedspace;
        $this->middleware('auth');

    }
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('booking');
    }

    public function estate_dashboard(facility_booking_student $facility_booking_student)
    {

       $reset_students = $this->facility_booking_student->get();
       
        $users = $this->facility_booking_student->with('User')->where("approval", "=", "pending")->first();
        $applied_approved = facility_booking_student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "yes")->get();

        $applied_rejected = facility_booking_student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "no")->get();
     
        $count = [];
        
        $count["total_application"] = $this->facility_booking_student->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $booked = $this->facility_booking_student->where("approval", "=", "yes")->count();

        $booked_gents = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "male")->count();

        $booked_ladies = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "female")->count();

        $total = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->first()->space;
        $total_ladies = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->where("gender_for", "=", "female")->first()->space;
        $total_gents = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->where("gender_for", "=", "male")->first()->space;
       $booked_total = $booked_ladies + $booked_gents;

      
       $not_booked =  $total - $booked_total;
       // dd($total_gents);

       // dd($booked_total);
        $not_booked_ladies = $total_ladies - $booked_ladies;
        $not_booked_gents = $total_gents - $booked_gents;
        
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $chart = Charts::database($applied_approved, 'bar', 'highcharts')
                  ->title("Monthly new application")
                  ->elementLabel("Total application")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);

                  

        $pie_ladies =  Charts::create('pie', 'highcharts')
                    ->title('Total bed space for ladies')
                    ->labels(['Remaining Space','Booked' ])
                    ->values([$not_booked_ladies, $booked_ladies ])
                    ->dimensions(500,250)
                    ->responsive(true);

        $pie_gents  =  Charts::create('pie', 'highcharts')
                    ->title('Total bed space for Gents')
                    ->labels(['Remaining Space','Booked' ])
                    ->values([$not_booked_gents, $booked_gents ])
                    ->dimensions(500,250)
                    ->responsive(true);
        

        return view('estate/dashboard',compact('chart','pie_ladies','pie_gents', 'booked', 'not_booked', 'booked_gents', 'booked_ladies', 'not_booked_ladies', 'not_booked_gents', 'total','total_gents','total_ladies'), $count);
    }

     public function approval()
    {
        
        return view('estate/approval');
    }

    //list of student's application
         public function student_list()
    {
        $count = [];
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();

        $count["applications"] = $this->facility_booking_student->with('User.next_of_kin')->orderBy( "approval", "DESC")->get();

        return view('estate/student_list', $count);
    }

    //approve on action column in the list of student's application

    public function approve(Request $request, $id, User $User)
    {
        $count = [];
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $approval = $this->facility_booking_student->find($id);
        if($approval){
          $bed_space = $this->bedspace->where('programme_id',$approval->programme_id)->where('year',$approval->year_of_study)->where('gender_for',$approval->gender)->get();
  $bed_space_count = $this->bedspace->where('programme_id',$approval->programme_id)->where('year',$approval->year_of_study)->where('gender_for',$approval->gender)->count();
for($i=0;$i<$bed_space_count;$i++){

$left_space= ((($bed_space[$i]->room_to-$bed_space[$i]->room_from)+1)*$bed_space[$i]->occupants_per_room) - $bed_space[$i]->occupied_by;
          $capacity= ((($bed_space[$i]->room_to-$bed_space[$i]->room_from)+1)*$bed_space[$i]->occupants_per_room);
          if($left_space == 0){
            continue;

          }

          $room_allocation = floor($bed_space[$i]->occupied_by/$bed_space[$i]->occupants_per_room)+$bed_space[$i]->room_from;


            $approval->room_allocated = $room_allocation;
            $approval->bed_space_id = $bed_space[$i]->id;
            $approval->approval = $request->approve;
            $approval->save();


            $bed_space_allocated = $this->bedspace->find($bed_space[$i]->id);
            $bed_space_allocated->occupied_by = $bed_space[$i]->occupied_by+1;
            
            $bed_space_allocated->save();

            $approvals = $this->facility_booking_student->with('bedspace')->where('id',$approval->id)->first();
            Mail::to($request->user_email)->send(new Success($approvals));

            return redirect()->back();
}
//return redirect()->back();
return back()->withStatus(__('No bed space available'));         
        }
        
        $count["applications"] = $this->facility_booking_student->with('User')->get();

        return view('estate/student_list', $count);
    }


    //reject on action column in the list of the student's application 
     public function reject(Request $request, $id, User $User, reject $reject)
    {
        $count = [];
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();


            $rejection = new reject();
            $rejection->application_id = $request -> application_id;
            $rejection->reason = $request -> reject_reason;
            $rejection->rejected_by = $request -> person;
            $rejection->save();

            $rejects = $this->reject->orderBy('created_at','desc')->first()->reason;

         

        $reject = $this->facility_booking_student->find( $id);
        if($reject){
            $reject->approval = $request -> reject;
            $reject->save();
            Mail::to($request->user_email)->send(new Failure($rejects));

            return redirect()->back(); 
        }
        
        $count["applications"] = $this->facility_booking_student->with('User')->get();

        return view('estate/student_list', $count);
    }



// functions below are for public user
      public function public_user_list()
    {
        $count = [];
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["applications"] = $this->facility_booking_public->with('facility')->orderBy("id", "DESC")->get();

// dd($count);
        return view('estate/public_user_list', $count);
    }



    public function approve_public(Request $request, $id, User $User)
    {
        $count = [];
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["notification"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $approval = $this->facility_booking_public->find( $id);
        if($approval){
            // Mail::to($request->user_email)->send(new Success_Public($User));

            $approval->approval = $request -> approve;
            $approval->save();
            return redirect()->back();
        }
        
        $count["applications"] = $this->facility_booking_public->with('User')->get();

        return view('estate/public_user_list', $count);
    }


   
     public function reject_public(Request $request, $id, User $User, reject $reject)
    {
        $count = [];
        $count["notification"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();



            $rejection = new reject();
            $rejection->application_id = $request -> application_id;
            $rejection->reason = $request -> reject_reason;
            $rejection->rejected_by = $request -> person;
            $rejection->save();


             $rejects = $this->reject->orderBy('created_at','desc')->first()->reason;

        $reject = $this->facility_booking_public->find( $id);
        if($reject){


            $reject->approval = $request -> reject;
            $reject->save();

            // Mail::to($request->user_email)->send(new Failure_Public($rejects));
            return redirect()->back();
        }
        
        $count["applications"] = $this->facility_booking_public->with('User')->get();

        return view('estate/public_user_list', $count);
    }

     public function public_summary(){
      $count = [];
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();


// start count logic for public summary
        $applied_approved = facility_booking_public::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "yes")->get();

        $count["total_application"] = $this->facility_booking_public->count();
      
        $count["booked"] = $this->facility_booking_public->where("approval", "=", "yes")->count();

        

        $count["facility"] = $this->facility->count();
       


        $count["chart"] = Charts::database($applied_approved, 'bar', 'highcharts')
                  ->title("Monthly new application")
                  ->elementLabel("Total application")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);

                  

        // end logic for public summary


        return view('estate/public_summary', $count);
    }


// end of public user

      public function reset(facility_booking_student $facility_booking_student, ResetStudents $ResetStudents){
        $count = $this->facility_booking_student->count();

       

        if($count != 0 ){

         $reset_students = $this->facility_booking_student->get()->toArray();
                  
         foreach ($reset_students as $reset) {
        
          if(ResetStudents::insert($reset_students)){
             DB::statement("SET foreign_key_checks=0");
         facility_booking_student::truncate();
         DB::statement("SET foreign_key_checks=1");

            
          return redirect()->back();
          
        }else{
           return redirect()->back();
        }

         }

        
    }else{
      return redirect()->back();
    }
       
    }

     public function resetPublic(facility_booking_public $facility_booking_public, ResetPublic $ResetPublic){
        $count = $this->facility_booking_public->count();

       

        if($count != 0 ){

         $reset_public = $this->facility_booking_public->get()->toArray();
                  
         foreach ($reset_public as $reset) {
        
          if(ResetPublic::insert($reset_public)){
             DB::statement("SET foreign_key_checks=0");
         facility_booking_public::truncate();
         DB::statement("SET foreign_key_checks=1");

            
          return redirect()->back();
          
        }else{
           return redirect()->back();
        }

         }

        
    }else{
      return redirect()->back();
    }
       
    }


      public function mail(reject $reject){
        $rejects = $this->reject->where('created_at','desc')->first();
        return view('emails/failure',compact('rejects'));
    }

    

//functions for admin dashboard starts here

  //function for admin dashboard starts here  
    public function admin_dashboard(facility_booking_student $facility_booking_student)
    {

       $reset_students = $this->facility_booking_student->get();
       
        $users = $this->facility_booking_student->with('User')->where("approval", "=", "pending")->first();
        $applied_approved = facility_booking_student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "yes")->get();

        $applied_rejected = facility_booking_student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "no")->get();
     
        $count = [];
        
        $count["total_application"] = $this->facility_booking_student->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $booked = $this->facility_booking_student->where("approval", "=", "yes")->count();

        $booked_gents = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "male")->count();

        $booked_ladies = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "female")->count();

        $total = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->first()->space;
        $total_ladies = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->where("gender_for", "=", "female")->first()->space;
        $total_gents = DB::table('tbl_bed_space')->select(DB::raw("SUM(space) as space"))->where("gender_for", "=", "male")->first()->space;
       $booked_total = $booked_ladies + $booked_gents;

      
       $not_booked =  $total - $booked_total;
       // dd($total_gents);

       // dd($booked_total);
        $not_booked_ladies = $total_ladies - $booked_ladies;
        $not_booked_gents = $total_gents - $booked_gents;
        
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $chart = Charts::database($applied_approved, 'bar', 'highcharts')
                  ->title("Monthly new application")
                  ->elementLabel("Total application")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);

                  

        $pie_ladies =  Charts::create('pie', 'highcharts')
                    ->title('Total bed space for ladies')
                    ->labels(['Remaining Space','Booked' ])
                    ->values([$not_booked_ladies, $booked_ladies ])
                    ->dimensions(500,250)
                    ->responsive(true);

        $pie_gents  =  Charts::create('pie', 'highcharts')
                    ->title('Total bed space for Gents')
                    ->labels(['Remaining Space','Booked' ])
                    ->values([$not_booked_gents, $booked_gents ])
                    ->dimensions(500,250)
                    ->responsive(true);
        

        return view('admin/dashboard',compact('chart','pie_ladies','pie_gents', 'booked', 'not_booked', 'booked_gents', 'booked_ladies', 'not_booked_ladies', 'not_booked_gents', 'total','total_gents','total_ladies'), $count);
    }
  //function for admin dashboard end here  
  
  //function for admin dashboard student application list starts here  
    public function admin_student_list()
        {
            $count = [];
            $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
            $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();

            $count["applications"] = $this->facility_booking_student->with('User.next_of_kin')->orderBy( "approval", "DESC")->get();
    
            return view('admin/admin_student_list', $count);
        }
  //function for admin dashboard student application list end here

  //function for admin dashboard public application list starts here
      public function admin_public_user_list()
    {
        $count = [];
        $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $count["applications"] = $this->facility_booking_public->with('user')->with('facility')->orderBy("created_at", "DESC")->where('facility_id','!=','15')->get();
    // dd($count);
        return view('admin/admin_public_user_list', $count);
    }
  //function for admin dashboard public application list end here

  //function for admin dashboard public summary starts here
    public function admin_public_summary(){
        $count = [];
          $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
          $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();


      // start count logic for public summary
        $applied_approved = facility_booking_public::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where("approval", "=", "yes")->get();

        $count["total_application"] = $this->facility_booking_public->count();
      
        $count["booked"] = $this->facility_booking_public->where("approval", "=", "yes")->count();

        

        $count["facility"] = $this->facility->count();
       


        $count["chart"] = Charts::database($applied_approved, 'bar', 'highcharts')
                  ->title("Monthly new application")
                  ->elementLabel("Total application")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);
      // end logic for public summary

        return view('admin/admin_public_summary', $count);
    }
  //function for admin public summary end here

  
  //function for admin add student starts here
    public function admin_students(){
        $count = [];
          $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
          $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();

        $count["students"] = User::with('programmes')->where('role_id',2)->get();
        $count["programmes"] = $this->programmes->get();
      return view('admin/admin_manage_students', $count);
    }
  //function for admin  add studen end here
    // edit student

//function for admin dashboard public summary starts here
    public function admin_students_edit(User $User,Request $request){
            $User = new User();
        $User = User::find($request -> stu_id);

            $User->first_name = $request -> first_name;
            $User->last_name = $request -> last_name;
            $User->email = $request -> email;
            $User->programmes_id = $request -> prog;
            $User->save();

      return back();
    }



     public function admin_programme_edit(programmes $programme,Request $request){
            $programme = new programmes();
        $programme = programmes::find($request -> prog_id);

            $programme->programme_code = $request -> programme_code;
            $programme->programme_name = $request -> programme_name;
            $programme->save();

      return back();
    }

       public function admin_email_edit(User $user,Request $request){
            $user = new User();
        $user = User::where('id',$request -> user_id)->first();

            $user->email = $request -> email;
            $user->save();

      return back();
    }
  //function for admin dashboard public summary end here
    // end of edit student
  //function for admin dashboard public summary starts here
    public function admin_estate_users(){
        $count = [];
          $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
          $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();

          $count["estate_users"] = User::where('role_id',4)->get();
        return view('admin/admin_manage_estates', $count);
    }
  //function for admin dashboard public summary end here


 public function admin_programmes(){
        $count = [];
          $count["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
          $count["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();

          $count["programmes"] = $this->programmes->get();
                  return view('admin/admin_programmes', $count);
    }
    // deleting users

public function delete_user(Request $request){
  $id = $request->user_id;
  $user = User::find($id);
    DB::statement("SET foreign_key_checks=0");
  $user->delete();
        
         DB::statement("SET foreign_key_checks=1");
  return redirect()->back()->withStatus(__('User successfully deleted.'));
}


public function delete_prog(Request $request){
  $id = $request->prog_id;
  $programme = programmes::find($id);
    DB::statement("SET foreign_key_checks=0");
  $programme->delete();
        
         DB::statement("SET foreign_key_checks=1");
  return redirect()->back()->withStatus(__('programme successfully deleted.'));
}

    // end of deleting users

// deleting users

public function add_user(Request $request){
        $default_password = "12345678";
            $user = new User();
        $user->first_name = $request -> first_name;
        $user->middlename = $request -> middle_name;
        $user->last_name = $request -> last_name;
        $user->gender = $request -> gender;
        $user->email = $request -> email;
        $user->role_id = '4';
        $user->password = Hash::make($default_password);
        $user->save();

  return redirect()->back()->withStatus(__('User successfully added.'));
}


    // end of deleting users
//importing registration numbers
public function admin_import_students() 
    {
        Excel::import(new StudentImport,request()->file('file'));
           
        return back();
    }

//importing programmes
public function admin_import_programmes() 
    {
        Excel::import(new ProgrammeImport,request()->file('file'));
           
        return back();
    }

}
