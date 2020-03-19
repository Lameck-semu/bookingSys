@extends('layouts.headeradmin')
@section('content')

 <div class="container-scroller">
  <link href="{{ asset('data-table/css/styleee.css')}}" rel="stylesheet">  
           <div class="col-12 grid-margin"  >
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Import Hall Specificatins</h4>
                  <span class="btn btn-info pull-right" style="color: white; float: right;" data-toggle="modal" data-target="#ModalAdd" >  Add Bedspaces </span>
                        
  <!-- Modal -->
          <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Add Bedspaces</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
            <form action="{{ route('admin_import_bedspace') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="file" name="file" class="form-control">
                          <br>
                          <button class="btn btn-success">Import Bedspaces</button>
                      </form>
                 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
<!-- end of modal -->

          </div>
        </div>
      </div>
  </div>


 <div class="col-12 grid-margin"  >
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Hall Specifications</h4>
                  <form class="form-sample" method="post" action="{{ route('store_hall')}}">
                    @csrf
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Hall Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="hall_name" class="form-control" required="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Hall Capacity</label>
                          <div class="col-sm-9">
                            <input type="number" name="space" class="form-control" required="" min="0"/>
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
                              <option value="">Select..</option>

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
                              <option value="">Select..</option>
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
                            <input type="number" name="room_from" class="form-control" required="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Room To</label>
                          <div class="col-sm-9">
                            <input type="number" name="room_to" class="form-control" required="" min="0"/>
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
                            <select class="form-control" name="gender_for" required="">
                              <option>Select....</option>
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
                            <input type="number" name="occupants_per_room" class="form-control" required="" min="0"/>
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