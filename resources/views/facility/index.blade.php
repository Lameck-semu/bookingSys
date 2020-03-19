@extends('layouts.headerestate')
@section('content')
<br><br>
 <div class="container-scroller">
  <link href="{{ asset('data-table/css/styleee.css')}}" rel="stylesheet">
   <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Facility List</h4>
                  <!--<a href="{{ route('reset')}}" ><span class="btn btn-info pull-right" style="color: white; float: right;">  Reset </span></a>-->
                  <div class="table-responsive">
                    <table id="bootstrap-data-table-export4" class="display nowrap table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> No</th>
                          <th> Facility Name </th>
                          <th> Rate/Day </th>
                          <th> Booking Type </th>
                          <th> Action    </th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($facilities as $facility)
                        <tr>
                          <td class="font-weight-medium"> {{$loop->iteration}}</td>
                          <td> {{$facility->facility_name}}  </td>
                          <td>MK {{$facility->amount}}  </td>
                          <td> {{$facility->booking_type}}  </td>
                          <td>
        	
                           <a href="{{ route('edit_facility',$facility->id )}}"> <label  class="badge badge-primary" >Edit</label></a><br />
                            <form method="POST" action="{{ route('delete_facility',$facility->id )}} " id="{{$facility->id}}" >
                              @csrf
                          <br>
                            <button class="badge badge-danger" type="submit"   >Delete</button>  
                            </form>
                            
                          </td>
                        </tr>
                        @endforeach
                       
                        
                      </tbody>
                    </table>
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
                title: 'Hall of Residence List',
                filename: 'Hall of Residence List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Hall of Residence List',
                filename: 'Hall of Residence List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Hall of Residence List',
                filename: 'Hall of Residence List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Hall of Residence List',
                filename: 'Hall of Residence List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }, {
                extend: 'print',
                title: 'Hall of Residence List',
                filename: 'Hall of Residence List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
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