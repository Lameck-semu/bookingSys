<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\department as department;
use App\facility as facility;
use App\facility_booking_public as facility_booking_public;
use App\facility_booking_student as facility_booking_student;
use App\permission as permission;
use App\programmes as programmes;
use App\role as role;
use App\role_has_permission as role_has_permission;
use App\schools as schools;
use App\user as user;
use App\public_user as public_user;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;






class PublicController extends Controller
{
    //
    public function __construct(department $department, facility $facility, facility_booking_public $facility_booking_public, facility_booking_student $facility_booking_student, permission $permission, programmes $programmes, role $role, role_has_permission $role_has_permission, schools $schools, user $user, public_user $public_user)
    {
      $this->department = $department;
      $this->facility = $facility;
      $this->facility_booking_public = $facility_booking_public;
      $this->facility_booking_student = $facility_booking_student;
      $this->permission = $permission;
      $this->programmes = $programmes;
      $this->role = $role;
      $this->role_has_permission = $role_has_permission;
      $this->schools = $schools;
      $this->user = $user;
      $this->public_user = $public_user;
                
    }
       public function form()
    {
        $data = [];
        $data['facilities'] = $this->facility->all();
        return view('booking/form',$data);
    }

      public function select_facility(request $request,facility_booking_public $facility_booking_public,user $user)
    {

        $users=[];
        
      

        // $user->insert($users);

        $user_id = $this->user->orderby('id','desc')->first();
          $application=[];

      $place = $this->facility->orderBy('created_at', 'desc')->first()->id;
          
        $application["facility_id"] = $place;
        $application["from_who"] = $request->input('from_who');
        $application["number_of_participants"] = $request->input('number_of_participants');
        $application["first_name"] = $request->input('first_name');
        $application["last_name"] = $request->input('last_name');
        $application["starting_date"] =$request->input('start_date');
        $application["end_date"] = $request->input('end_date');
        // $application["number_of_days"] = $request->input('number_of_days');
        $application["starting_time"] = $request->input('time_from');
        $application["end_time"] = $request->input('time_to');


   $start = new \Carbon\Carbon($request->input('start_date'));

$end = \Carbon\Carbon::parse($request->input('end_date'));

$diff =  $end->diffInDays($start);
        // $number_of_days = $application["starting_date"] - $application["end_date"];
        $application["number_of_days"] = $diff;

        $application["booking_purpose"] = $request->input('booking_purpose');
        $application["approval"] = "pending";
        $application["status"] = "pending";
        $application["phone_number"] = $request->input('phone_number');
        $application["email"] = $request->input('mail');
      

          
         
        
        $facility_booking_public->insert($application);
        
        $dateFrom = $request->input('start_date');
        $dateTo = $request->input('end_date');
    
        $data = [];
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['number_of_days'] = $diff;
        $data['facilities'] = $this->facility->getAvailableRooms($dateFrom, $dateTo);
        $data["email"] = $request->input('phone_number');


        return view('booking/select_facility',$data);
    }


     public function update_facility(request $request,facility_booking_public $facility_booking_public,user $user)
    {
        // dd($request->input('facility_id'));
        $email = $request->input('email');
        $user_id = $this->facility_booking_public->orderby('id','desc')->first()->id;


        $facility_public = $this->facility_booking_public->where('id',$user_id)->first();

        $input = $request->all();
        $member = $input['facility_id'];
        //dd($input);
        for ($i=0; $i < count($member); $i++) { 
          if($i == 0){
        $facility_public->facility_id=$request->input('facility_id')[$i];
        $facility_public->save();
      }else{
        $facility_public_new = new facility_booking_public();

        $facility_public_new->facility_id=$request->input('facility_id')[$i];
        $facility_public_new->from_who=$facility_public->from_who;
        $facility_public_new->first_name=$facility_public->first_name;
        $facility_public_new->last_name=$facility_public->last_name;
        $facility_public_new->phone_number=$facility_public->phone_number;
        $facility_public_new->email=$facility_public->email;
        $facility_public_new->starting_date=$facility_public->starting_date;
        $facility_public_new->end_date=$facility_public->end_date;
        $facility_public_new->number_of_days=$facility_public->number_of_days;
        $facility_public_new->starting_time=$facility_public->starting_time;
        $facility_public_new->end_time=$facility_public->end_time;
        $facility_public_new->participants=$facility_public->participants;
        $facility_public_new->booking_purpose=$facility_public->booking_purpose;
        $facility_public_new->number_of_participants=$facility_public->number_of_participants;
        $facility_public_new->approval=$facility_public->approval;
        $facility_public_new->status=$facility_public->status;

        $facility_public_new->save();


      }

        }

// dd($request->input('book_again'));

        
       // return view('public_user/upload_deposit_slip',$data);


        if($request->input('book_again') == 'on'){


          $data = [];
          $data['from_who'] =$facility_public->from_who;
          $data['first_name'] =$facility_public->first_name;
          $data['last_name'] =$facility_public->last_name;
          $data['phone_number'] =$facility_public->phone_number;
          $data['email'] =$facility_public->email;
          $data["approval"] = "pending";
        $data["status"] = "pending";
        $data['facilities'] = $this->facility->all();
        
        return view('booking.book_again',$data);

        }else{
        return redirect('/booking');
      }
       

    }
    public function upload_deposit_slip(request $request,facility_booking_public $facility_booking_public,user $user)
    {
        // dd($request->input('facility_id'));
        $email = $request->input('email');
        $user_id = $this->user->where('email',$email)->first()->id;

    $facility_public = $this->facility_booking_public->where('user_id',$user_id)->first();
        

         // code for uploading images
          $destination_path = public_path('/images/deposit_slips/public');
          $image=$request->file('image');
           $facility_public->image = $image->getClientOriginalName();
          $image->move($destination_path,$facility_public->image);

          // end of code for uploading images
        $facility_public->save();
        
       return redirect('/booking');

    }

      public function logged_in(request $request,facility_booking_public $facility_booking_public)
    {

      if($request->isMethod('post')){

    $facility_public = $this->facility_booking_public->where('user_id',Auth::user()->id)->orderby('id','desc')->first();
        


         // code for uploading images
          // $destination_path = public_path('/images/deposit_slips/public');
          // $image=$request->file('image');
          // $extension = $image->getClientOriginalExtension();
          //  $facility_public->image = Auth::user()->first_name.' '.Auth::user()->last_name.'.'.$extension;
          // $image->move($destination_path,$facility_public->image);
          // end of code for uploading images
        $facility_public->save();
        return redirect()->back();
        }
        
       
        return view('booking/logged_in_public_user');

    }

     

}
