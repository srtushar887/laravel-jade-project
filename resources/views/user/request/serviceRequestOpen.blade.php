@extends('layouts.user')
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
@section('user')





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Active Request</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-responsive m-t-40">
                        <table id="example23"
                               class="display nowrap table table-hover table-striped table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Property</th>
                                <th>Request</th>
                                <th>Priority</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Property</th>
                                <th>Request</th>
                                <th>Priority</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                                <th>Last Updated</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($active_request as $acreq)
                                <tr>
                                    <td>{{$acreq->property->property_name}}</td>
                                    <td>{{$acreq->request_title}}</td>
                                    <td>
                                        @if($acreq->sel_priority == 1)
                                            Normal
                                        @elseif($acreq->sel_priority == 2)
                                            Important
                                        @else
                                            Urgent
                                        @endif

                                    </td>
                                    <td>{{$acreq->request_des}}</td>
                                    <td>
                                        @if($acreq->status == 0)
                                            Submited
                                        @elseif($acreq->sel_priority == 1)
                                            Inprocess
                                        @elseif($acreq->sel_priority == 1)
                                            Complete
                                        @else
                                            Urgent
                                        @endif

                                    </td>
                                    <td>{{$acreq->created_at}}</td>
                                    <td>{{$acreq->updated_at}}</td>
                                </tr>
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
