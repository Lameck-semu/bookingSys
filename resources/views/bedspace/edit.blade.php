 @extends('layouts.headerestate')
@section('content')


 <div class="col-12 grid-margin"  >
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit the Hall of Residence</h4>
                  <form class="form-sample" method="post" action="{{ route('update_hall', $bedspace->id)}}">
                    @csrf
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Hall Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="hall_name" class="form-control"  value="{{$bedspace->hall_name}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Capacity</label>
                          <div class="col-sm-9">
                            <input type="number" name="space" class="form-control" value="{{$bedspace->space}}" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Programme</label>
                          <div class="col-sm-9">
                          
                           <select name="programme_id" class="form-control" id="">
                            
                              <option value="{{$bedspace->programme_id}}">{{$bedspace->programmes->programme_name}}</option>
                              @foreach($programmes as $prog)
                              <option value="{{$prog->id}}">{{$prog->programme_name}}</option>
                              @endforeach
                            </select>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Year</label>
                          <div class="col-sm-9">
                          <select name="year" class="form-control" id="">
                              <option value="{{$bedspace->year}}">{{$bedspace->year}}</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Room From</label>
                          <div class="col-sm-9">
                            <input type="number" name="room_from" class="form-control" required="" value="{{$bedspace->room_from}}"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Room To</label>
                          <div class="col-sm-9">
                            <input type="number" value="{{$bedspace->room_to}}" name="room_to" class="form-control" required="" min="0"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="gender_for" >

                              <option value="{{$bedspace->gender_for}}">{{$bedspace->gender_for}}</option>
                              <option value="">Select..</option>
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Occupants Per Room</label>
                          <div class="col-sm-9">
                            <input type="number" name="occupants_per_room" class="form-control" required="" min="0" value="{{$bedspace->occupants_per_room}}">
                          </div>
                        </div>
                      </div>
                     
                    </div>
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