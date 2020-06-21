@extends('layouts.admin')
@section('css')


    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="{{asset('assets/admintwo/')}}/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admintwo/')}}/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admintwo/')}}/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="{{asset('assets/admintwo/')}}/assets/dist/css/style.min.css" rel="stylesheet">
    <style>
        div.dt-buttons{
            position:relative;
            float:right;
        }
    </style>
@endsection
@section('admin')



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking List</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-responsive m-t-40">
                        <table id="example23"
                               class="display nowrap table table-hover table-striped table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>User First Name</th>
                                <th>User Last Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>User First Name</th>
                                <th>User Last Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($user_booking as $pro)
                                <tr>
                                    <td>
                                        @if (!empty($pro->user->first_name))
                                            {{$pro->user->first_name}}
                                        @endif
                                        </td>
                                    <td>
                                        @if (!empty($pro->user->last_name))
                                            {{$pro->user->last_name}}
                                        @endif
                                        </td>
                                    <td>{{$pro->start_date}}</td>
                                    <td>{{$pro->end_date}}</td>
                                    <td>
                                        @if($pro->status == 1)
                                            Pending
                                        @elseif($pro->status == 2)
                                            Confirmed
                                        @elseif($pro->status == 3)
                                            Rejected
                                        @else
                                            Active
                                        @endif

                                    </td>
                                    <td>

                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#poolbok{{$pro->id}}"><i class="fa fa-eye"></i></button>
                                    </td>
                                </tr>


                                <div class="modal fade" id="poolbok{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <form action="{{route('admin.booking.save')}}" method="post">
                                        @csrf
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Booking</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Select Action</label>
                                                        <input type="hidden" name="booking_id" value="{{$pro->id}}" class="bookingid">
                                                        <select class="form-control" name="action">
                                                            <option value="0">select any</option>
                                                            <option value="1">Confirm</option>
                                                            <option value="2">Reject</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea type="text" name="message" class="form-control"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger waves-effect text-left" >Save</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </form>
                                </div>


                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
@section('js')






    <script src="{{asset('assets/admintwo/')}}/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/admintwo/')}}/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>



    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
            // responsive table
            $('#config-table').DataTable({
                responsive: true
            });
            $('#example23').DataTable({
                dom: 'frtipB',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        });

    </script>


@endsection
