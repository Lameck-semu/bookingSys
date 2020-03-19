@extends('layouts.headeradmin')
@section('content')

 <div class="col-12 grid-margin"  >
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Facility</h4>
                  <form class="form-sample" method="post" action="{{ route('admin_update_public_facility', $facility->id)}})}}">
                    @csrf
                    <br>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Facility Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="facility_name" class="form-control" value="{{$facility->facility_name}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Rate per day</label>
                          <div class="col-sm-9">
                            <input type="number" name="amount" class="form-control" value="{{$facility->amount}}" />
                          </div>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Booking Type</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="booking_type">
                                <option value="multi">Multi</option>
                                <option value="single">Single</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <br>
                    <div class="row">
                      
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-5 "></div>
                          <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="Submit">
                          </div>
                          <div class="col-sm-5"></div>
                        </div>
                      </div>
                    </div>
                   
                  </form>
                </div>
              </div>
        </div>

@endsection