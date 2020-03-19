<?php

namespace App\Http\Controllers;
use App\facility as facility;
use App\public_user as public_user;
use App\facility_booking_public as facility_booking_public;
use App\facility_booking_student as facility_booking_student;

use Illuminate\Http\Request;

class FacilityController extends Controller
{
     public function __construct(public_user $public_user,facility_booking_public $facility_booking_public,facility_booking_student $facility_booking_student, facility $facility){
        $this-> public_user = $public_user;
        $this-> facility = $facility;    
        $this-> facility_booking_public = $facility_booking_public;
        $this-> facility_booking_student = $facility_booking_student;

        $this->middleware('auth');

    }
   
    //
     public function index()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();

        
        $facilities = facility::where('id','!=','15')->get();
        return view('facility/index',compact('facilities','notification', 'notification_public'));
    }


    public function create()
    {
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();

        return view('facility/create',compact('notification','notification_public'));
    }


    public function store(Request $request)
    {
        
        $facility = new facility();
        $facility -> booking_type = $request -> booking_type;
        $facility -> facility_name = $request -> facility_name;
        $facility -> amount = $request -> amount;
        $facility -> description = 'none';
        $facility -> capacity = '0';
        $facility -> save();
        return redirect()->back()->withStatus(__('Facility successfully added.'));
    }

 

    public function edit($id)
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $facility = facility::find($id);
        return view('facility/edit',compact('facility','notification','notification_public'));
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
        
        
        $facility = facility::find($id);
        $facility -> booking_type = $request -> booking_type;
        $facility -> facility_name = $request -> facility_name;
        $facility -> amount = $request -> amount;
        $facility -> description = 'none';
        $facility -> capacity = '0';
        $facility -> save();
        return redirect('/facility_list')->withStatus(__('Facility successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        $facility = facility::find($id);
        $facility -> delete();
        return redirect()->back()->withStatus(__('facility successfully deleted.'));
    }

//functions for admin facility starts here
    public function admin_index()
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();

        
        $facilities = facility::where('id','!=','15')->get();
        return view('admin_facility/admin_index',compact('facilities','notification', 'notification_public'));
    }

    public function admin_create()
    {
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();

        return view('admin_facility/admin_create',compact('notification','notification_public'));
    }

    public function admin_store(Request $request)
    {
        
        $facility = new facility();
        $facility -> booking_type = $request -> booking_type;
        $facility -> facility_name = $request -> facility_name;
        $facility -> amount = $request -> amount;
        $facility -> description = 'none';
        $facility -> capacity = '0';
        $facility -> save();
        return redirect()->back()->withStatus(__('Facility successfully added.'));
    }

    public function admin_edit($id)
    {
        $notification = $this->facility_booking_student->where("approval", "=", "pending")->count();
        $notification_public = $this->facility_booking_public->where("approval", "=", "pending")->count();
        $facility = facility::find($id);
        return view('admin_facility/admin_edit',compact('facility','notification','notification_public'));
    }

    public function admin_update(Request $request, $id)
    {
        $facility = facility::find($id);
        $facility -> booking_type = $request -> booking_type;
        $facility -> facility_name = $request -> facility_name;
        $facility -> amount = $request -> amount;
        $facility -> description = 'none';
        $facility -> capacity = '0';
        $facility -> save();
        return redirect('/admin_facility_list')->withStatus(__('Facility successfully updated.'));
    }

    public function admin_delete($id)
    {
        
        $facility = facility::find($id);
        $facility -> delete();
        return redirect()->back()->withStatus(__('facility successfully deleted.'));
    }
//functions for admin facility end here

}
