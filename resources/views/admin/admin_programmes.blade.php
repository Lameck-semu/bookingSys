@extends('layouts.headeradmin')
@section('content')
<br><br>
 <div class="container-scroller">
  <link href="{{ asset('data-table/css/styleee.css')}}" rel="stylesheet">
   <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Programmes</h4>
                  <span class="btn btn-info pull-right" style="color: white; float: right;" data-toggle="modal" data-target="#ModalAdd" >  Add new programmes   </span>
                  <div class="table-responsive table-hover">
                    <table id="bootstrap-data-table-export4" class="display nowrap table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> Sn</th>
                          <th> Programme Code</th>
                          <th> Programme  Name</th>
                          <th> Action    </th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($programmes as $prog)
                        <tr>
                          <td class="font-weight-medium"> {{$loop->iteration}}</td>
                          <td>  {{$prog->programme_code}}</td>
                          <td>  {{$prog->programme_name}}</td>
                       
                          <td>
                       
                            <a href="" style="cursor: pointer;" data-toggle="modal" data-target="#Modal{{$prog->id}}" class="btn btn-info">Edit</a> 
                            <form action="{{route('delete_prog')}}" method="POST">
                        @csrf
                              
                              <input type="hidden" name="prog_id" value="{{$prog->id}}">
                              <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                          </td>
                        </tr>
 
                                    <!-- Modal -->
<div class="modal fade" id="Modal{{$prog->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{$prog->programme_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin_programme_edit', ['prog_id'=>$prog->id])}}" method="POST">
          @csrf
          <input type="text" value="{{$prog->programme_code}}" class="form-control" name="programme_code">
          <br>
          <input type="text" value="{{$prog->programme_name}}" class="form-control" name="programme_name">
          <br>
          <input type="hidden" name="prog_id" value="{{$prog->id}}" >
         

          <br>
          <input type="submit" value="Submit" class="btn btn-primary">

        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->

                        @endforeach

  <!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Programmes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form action="{{ route('admin_import_programmes') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import programmes</button>
            </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->



                   
                       
                        
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
                title: 'Programmes',
                filename: 'Programmes',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Programmes',
                filename: 'Programmes',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Programmes',
                filename: 'Programmes',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Programmes',
                filename: 'Programmes',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'print',
                title: 'Programmes',
                filename: 'Programmes',
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