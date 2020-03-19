<?php

namespace App\Http\Controllers;
use App\bedspace as bedspace;
use App\programmes as programmes;
use App\User as User;
use App\ResetStudents as ResetStudents;
use App\Imports\BedspaceImport;
use App\rooms as rooms;
use App\facility_booking_student as facility_booking_student;
use App\facility_booking_public as facility_booking_public;
use Excel;

use Illuminate\Http\Request;

class BedspaceController extends Controller
{


     public function __construct(User $User, facility_booking_student $facility_booking_student, facility_booking_public $facility_booking_public, ResetStudents $ResetStudents, bedspace $bedspace, programmes $programmes){
        $this->User = $User;
        $this->bedspace = $bedspace;
        $this->programmes = $programmes;
        $this->facility_booking_student = $facility_booking_student;
        $this->facility_booking_public = $facility_booking_public;
        $this->ResetStudents = $ResetStudents;
        $this->middleware('auth');

    }
   
    //
     public function index()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        
        $bedspaces = bedspace::orderby('hall_name')->with('programmes')->paginate(1000);
        return view('bedspace/index',compact('bedspaces','notification','notification_public'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $programmes=$this->programmes->all();
        return view('bedspace/create',compact('notification','notification_public','programmes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
        $bedspace = new bedspace();
        $bedspace->hall_name = $request->hall_name;
        $bedspace->space = $request->space;
        $bedspace->gender_for = $request->gender_for;
        $bedspace->occupants_per_room = $request->occupants_per_room;
        $bedspace->room_from = $request->room_from;
        $bedspace->room_to = $request->room_to;
        $bedspace->programme_id = $request->programme_id;
        $bedspace->year = $request->year;
        $bedspace->save();
        
        return redirect()->back()->withStatus(__('Hall successfully added.'));
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $bedspace = bedspace::with('programmes')->find($id);
        $programmes = programmes::all();
        return view('bedspace/edit',compact('bedspace','notification', 'notification_public','programmes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $bedspace = bedspace::find($id);
        $bedspace->hall_name = $request->hall_name;
        $bedspace->space = $request->space;
        $bedspace->gender_for = $request->gender_for;
        $bedspace->occupants_per_room = $request->occupants_per_room;
        $bedspace->room_from = $request->room_from;
        $bedspace->room_to = $request->room_to;
        $bedspace->programme_id = $request->programme_id;
        $bedspace->year = $request->year;
        $bedspace -> save();
       
        return redirect('/hall_list')->withStatus(__('bedspace successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        $bedspace = bedspace::find($id);
        $bedspace -> delete();
        return redirect()->back()->withStatus(__('bedspace successfully deleted.'));
    }


//functions for admin bedspace starts here
    public function admin_create()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $programmes=$this->programmes->all();
        return view('admin_bedspace/admin_create',compact('notification','notification_public','programmes'));
    }    

    public function admin_index()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        
        $bedspaces = bedspace::orderby('hall_name')->with('programmes')->paginate(1000);
        return view('admin_bedspace/admin_index',compact('bedspaces','notification','notification_public'));
    }
    

    public function admin_edit($id)
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $bedspace = bedspace::with('programmes')->find($id);
        $programmes = programmes::all();
        return view('admin_bedspace/admin_edit',compact('bedspace','notification', 'notification_public','programmes'));
    }


    public function admin_update(Request $request, $id)
    {
        
        $bedspace = bedspace::find($id);
        $bedspace->hall_name = $request->hall_name;
        $bedspace->space = $request->space;
        $bedspace->gender_for = $request->gender_for;
        $bedspace->occupants_per_room = $request->occupants_per_room;
        $bedspace->room_from = $request->room_from;
        $bedspace->room_to = $request->room_to;
        $bedspace->programme_id = $request->programme_id;
        $bedspace->year = $request->year;
        $bedspace -> save();
       
        return redirect('/admin_hall_list')->withStatus(__('bedspace successfully updated.'));
    }


    public function admin_delete($id)
    {       
        $bedspace = bedspace::find($id);
        $bedspace -> delete();
        return redirect()->back()->withStatus(__('bedspace successfully deleted.'));
    }


    public function admin_store(Request $request)
    {   
        $bedspace = new bedspace();
        $bedspace->hall_name = $request->hall_name;
        $bedspace->space = $request->space;
        $bedspace->gender_for = $request->gender_for;
        $bedspace->occupants_per_room = $request->occupants_per_room;
        $bedspace->room_from = $request->room_from;
        $bedspace->room_to = $request->room_to;
        $bedspace->programme_id = $request->programme_id;
        $bedspace->year = $request->year;
        $bedspace->save();
        
        return redirect()->back()->withStatus(__('Hall successfully added.'));
    }
//functions for admin bedspace end here

    //importing bedspaces
public function admin_import_bedspace() 
    {
        Excel::import(new BedspaceImport,request()->file('file'));
           
        return back();
    }
}
 