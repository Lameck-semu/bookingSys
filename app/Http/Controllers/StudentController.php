<?php

namespace App\Http\Controllers;
use App\Mail\Success;
use App\User as User;
use App\next_of_kin as next_of_kin;
use App\bedspace as bedspace;
use App\facility as facility;
use App\facility_booking_student as facility_booking_student;
use App\facility_booking_public as facility_booking_public;
use App\Http\Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function __construct(User $User, facility_booking_student $facility_booking_student, facility_booking_public $facility_booking_public, facility $facility, next_of_kin $next_of_kin, bedspace $bedspace){
      $this-> next_of_kin = $next_of_kin;
      $this-> User = $User;
      $this-> facility = $facility;
    	$this-> bedspace = $bedspace;
      $this-> facility_booking_student = $facility_booking_student;
    	$this-> facility_booking_public = $facility_booking_public;
    	$this->middleware('auth');

    }

    public function index(){

      
        

   return view('student/new_student');
    }

    public function create(request $request, User $User,next_of_kin $next_of_kin, facility_booking_student $facility_booking_student, bedspace $bedspace ){

 $bed_count = $this->bedspace->count();
 //dd($bed_count); 
 
 if ($bed_count != 0) {
   $bed = $this->bedspace->orderBy('created_at', 'desc')->first()->id;
   if(Auth::user()->gender == "male"){
$space = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "male")->count();
}else{
$space = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "female")->count();
        }
        
        $application = [];
        $kin = [];
      if($request->isMethod('post')){
        // if($space >= 1){
          $application["users_id"] = $request->input('user_id');
          $application["year_of_study"] = $request->input('year_of_study');
          $application["bed_space_id"] = $bed;
          $application["previous_hall"] =$request->input('previous_hall');
          $application["room_number"] = $request->input('room_number');
          $application["disability"] = $request->input('disability');
          $application["gender"] = Auth::user()->gender;
          $application["programme_id"] = Auth::user()->programmes_id;
          $application["disability_specification"] = $request->input('disability_specification');
          $application["approval"] = "pending";
          $application["status"] = "pending";

          // code for uploading images
          $destination_path = public_path('/images/deposit_slips');
          $image=$request->file('image');
          $extension = $image->getClientOriginalExtension();
          $application["image"] = $request->input('user_name').'.'.$extension;
          $image->move($destination_path,$application["image"]);

          // end of code for uploading images


          $kin["user_id"] = $request->input('user_id');
          $kin["last_name"] = $request->input('kin_last_name');
          $kin["first_name"] = $request->input('kin_first_name');
          $kin["mobile_phone"] =$request->input('phone_number');
          $kin["relationship"] =$request->input('relationship');


          // check year of study + programme id +gender against allocated by admin and return back if no space
          $bed_space = $this->bedspace->where('programme_id',Auth::user()->programmes_id)->where('year',$request->input('year_of_study'))->where('gender_for',Auth::user()->gender)->get();
          $bed_space_count = $this->bedspace->where('programme_id',Auth::user()->programmes_id)->where('year',$request->input('year_of_study'))->where('gender_for',Auth::user()->gender)->count();
for($i=0;$i<$bed_space_count;$i++){

$left_space= ((($bed_space[$i]->room_to-$bed_space[$i]->room_from)+1)*$bed_space[$i]->occupants_per_room) - $bed_space[$i]->occupied_by;

         
        if($left_space != 0)
        {
          $facility_booking_student->insert($application);
            $next_of_kin->insert($kin);
            return redirect()->back();
        }else{
          continue;

        }
}


            return back()->withStatus(__('No space available'));


      // }else{
      //   return redirect()->back();
      // }

      }
      $data = [];
        $applications = $this->facility_booking_student->with('User')->with('bedspace')->orderBy("created_at", "DESC")->where("users_id", "=", Auth::user()->id)->first();
       
        $data["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $data["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $data["rooms"] = $this->facility_booking_student->count();
          $data["applied"] = 'not';

        if($applications!=null){
          $data["applied"] = $applications->users_id;
         $data["created_at"] = $applications->created_at;
         $data["approval"] = $applications->approval;
         $data["room_allocated"] = $applications->room_allocated;
         $data["hall"] = $applications->bedspace->hall_name;

        }




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
       if(Auth::user()->gender == 'male'){
        $data["not_booked"] = $total_gents - $booked_gents;
       }else{
        $data["not_booked"]  = $total_ladies - $booked_ladies;

       }
       // dd($data);


 }else{




 

if(Auth::user()->gender == "male"){
$space = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "male")->count();
}else{
$space = DB::table('tbl_facility_booking_student')->join('users','users.id','=',"users_id")->where("tbl_facility_booking_student.approval", "=", "yes")->where("users.gender", "=", "female")->count();
    		}
        
        $application = [];
        $kin = [];
    	if($request->isMethod('post')){
        // if($space >= 1){
          $application["users_id"] = $request->input('user_id');
          $application["year_of_study"] = $request->input('year_of_study');
          $application["bed_space_id"] = $bed;
          $application["previous_hall"] =$request->input('previous_hall');
          $application["room_number"] = $request->input('room_number');
          $application["disability"] = $request->input('disability');
          $application["disability_specification"] = $request->input('disability_specification');
          $application["approval"] = "pending";
          $application["status"] = "pending";

          // code for uploading images
          $destination_path = public_path('/images/deposit_slips');
          $image=$request->file('image');
          $extension = $image->getClientOriginalExtension();
          $application["image"] = $request->input('user_name').'.'.$extension;
          $image->move($destination_path,$application["image"]);

          // end of code for uploading images


          $kin["user_id"] = $request->input('user_id');
          $kin["last_name"] = $request->input('kin_last_name');
          $kin["first_name"] = $request->input('kin_first_name');
          $kin["mobile_phone"] =$request->input('phone_number');
          $kin["relationship"] =$request->input('relationship');


         
        if ($facility_booking_student->insert($application))
        {
            $next_of_kin->insert($kin);
            return redirect()->back();
        }else{

            return back()->withStatus(__('No space available'));
        }

      // }else{
      //   return redirect()->back();
      // }

    	}
      $data = [];
        $applications = $this->facility_booking_student->with('User')->orderBy("created_at", "DESC")->where("users_id", "=", Auth::user()->id)->first();
       
        $data["notification"] = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $data["notification_public"] = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $data["rooms"] = $this->facility_booking_student->count();
          $data["applied"] = 'not';

        if($applications!=null){
          $data["applied"] = $applications->users_id;
         $data["created_at"] = $applications->created_at;
         $data["approval"] = $applications->approval;

        }




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
       if(Auth::user()->gender == 'male'){
        $data["not_booked"] = $total_gents - $booked_gents;
       }else{
        $data["not_booked"]  = $total_ladies - $booked_ladies;

       }
       // dd($data);
       }
         
    	return view('student/new_student', $application, $data);
    	
    }

    public function first_year(){

      
      if($request->isMethod('post')){

        
      }

          return view('student/first_year');
    }

}
