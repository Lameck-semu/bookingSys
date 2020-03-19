@extends('layouts.headerestate')
@section('content')
<br><br>
 <div class="container-scroller">
  <link href="{{ asset('data-table/css/styleee.css')}}" rel="stylesheet">
   <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Facility Booking Applications</h4>

            <button style="float: right;" class="btn btn-info pull-right" type="submit"  ><span style="cursor: pointer;" data-toggle="modal" data-target="#Modal266">Reset</span></button>  

                 
                  <div class="table-responsive table-hover">
                    <table id="bootstrap-data-table-export4" class="display nowrap table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> No</th>
                          <th> From </th>
                          <th> Facility  </th>
                          <th> Date From  </th>
                          <th> Date To  </th>
                          <th> Action    </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($applications as $application)
                        <tr>
                          <td class="font-weight-medium"> {{$loop->iteration}}</td>
                          <td> <span style="cursor: pointer;" data-toggle="modal" data-target="#Modal{{$application->id}}"> {{$application->from_who}}</span></td>
                          <td>  {{$application->facility->facility_name}}</td>
                          <td>  {{$application->starting_date}}</td>
                          <td>  {{$application->end_date}}</td>
                          <td>
                            @if($application->approval== "pending")
                          
                            <form method="POST" action="{{ route('approve_public',$application->id)}} " id="{{$application->id}}">
                              @csrf
                              <input type="hidden" name="user_email" value="{{$application->email}} ">
                              
                            <button type="submit" class="badge badge-primary" name="approve" value="yes">Approve</button>
                            </form>
                            <br>
                            <button class="badge badge-warning" type="submit"  ><span style="cursor: pointer;" data-toggle="modal" data-target="#Modall{{$application->id}}">Reject</span></button>  
                            
                        
                            @elseif($application->approval== "yes")
                            <a href=""><label class="badge badge-success" >Approved</label> </a>
                             @else
                            <a href=""><label class="badge badge-danger" >Rejected</label> </a> 
                            @endif
                          </td>
                        </tr>

                                    <!-- Modal -->
<div class="modal fade" id="Modal{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalCenterTitle">{{$application->from_who}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        
          <!--<div class="col-md-6">
            <h5>Deposit Slip</h5>
            <hr>
        <img src="{{asset('images/deposit_slips/public/'.$application->image)}}" class="img-responsive" height="200px" width="200px">
        <br><br>
        <a href="{{asset('images/deposit_slips/public/'.$application->image)}}" download="{{$application->first_name}} {{$application->last_name}} deposit slip"><span class="btn btn-info">Download Slip</span></a>
            
          </div>-->
          <div class="col-md-12">
            <h5>Contact Person</h5>
            
            <p>{{$application->first_name}} {{$application->last_name}} </p>
            <hr>
            <h5>Phone Number</h5>
            
            <p>{{$application->phone_number}}</p>
            <hr>
            <h5>Booking Purpose</h5>
          
            <p>{{$application->booking_purpose}}</p>
            <hr>
            <h5>Number of Participants</h5>
            
            <p>{{$application->number_of_participants}}</p>
            <hr>
            <h5>Time From <em>-</em>  Time To</h5>
            
            <p>{{$application->starting_time}} <em>-</em> {{$application->end_time}}</p>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->



                        <!-- Modal -->
<div class="modal fade" id="Modall{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Reject the Application for {{$application->first_name}} {{$application->last_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            
            <hr>
            <form method="POST" action="{{ route('reject_public',$application->id)}} " id="{{$application->id}}" >
              @csrf
              <input type="hidden" name="user_email" value="{{$application->email}} ">
              <input type="hidden" name="person" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}} ">
              <input type="hidden" name="application_id" value="{{$application->id}} ">
              <input type="hidden" name="reject" value="no">

              <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Reason for Rejection</label>
                            <div class="col-sm-9">
                            <textarea class="form-control" name="reject_reason" cols="10" rows="3" required=""></textarea>
                          </div>
                        </div>
                      </div>
              
            <button class="badge badge-info" type="submit"  >Submit </button>  
            </form>
            
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
                        @endforeach
                       
                        
                      </tbody>
                    </table>


                        <!-- Modal -->
<div class="modal fade" id="Modal266" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation of Reset  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

              <div class="col-md-12">
                        
                          <p class="col-sm-12 col-form-label"><em>Are you sure you want to reset the applications? check everything before reseting.</em></p>
                            
                        
                      </div>

              
            
            
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{ route('resetPublic')}}" ><span class="btn btn-info pull-right" style="color: white; float: left;">  OK </span></a> 
            
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>


     <script src="data-table/js/js1/jquery.data Tables.js"></script>

    <script src="data-table/js/data-table/dataTables.bootstrap.min.js"></script>
    <script src="data-table/js/data-table/jquery.dataTables.min.js"></script>
    <script src="data-table/js/data-table/jquery-1.12.4.js"></script>

    <script src="data-table/js/datatables/datatables.min.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="data-table/js/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="data-table/js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="data-table/js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.js"></script>
    <script src="data-table/js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
   <!--  <script src="js/datatables/datatables-init.js"></script> -->
    <script type="text/javascript">
            $('#bootstrap-data-table-export4').DataTable({
        lengthMenu: [[10, 20,25, 50, 75, 100, -1], [10, 20, 25, 50, 75, 100, "All"]], 
        dom: 'lBfrtip',
        buttons: [
           {
                extend: 'copyHtml5',
                title: 'Public Application List',
                filename: 'Public Application List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Public Application List',
                filename: 'Public Application List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Public Application List',
                filename: 'Public Application List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Public Application List',
                filename: 'Public Application List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'print',
                title: 'Public Application List',
                filename: 'Public Application List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }
        ]
         
    });
    
    $('#row-select').DataTable( {
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    </script>

    <!-- <div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Bar chart</h4>
        <canvas id="barChart" style="height:230px"></canvas>
      </div>
    </div>
  </div> -->
   @endsection