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

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Property</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{route('admin.create.property')}}">

                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                    </a>
                </div>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Property List</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-responsive m-t-40">
                        <table id="example23"
                               class="display nowrap table table-hover table-striped table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Property Name</th>
                                <th>Property Address</th>
                                <th>Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Property Name</th>
                                <th>Property Address</th>
                                <th>Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($property as $pro)
                                <tr>
                                    <td>{{$pro->property_name}}</td>
                                    <td>{{$pro->property_address}}</td>
                                    <td>
                                        @if($pro->status == 1)
                                            Publish
                                        @else
                                            Un-Publish
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{route('admin.property.edit',$pro->id)}}">

                                            <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#property-delete{{$pro->id}}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <div class="modal fade" id="property-delete{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <form action="{{route('admin.property.delete')}}" method="post">
                                        @csrf
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Delete property</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="delete_property" class="del_pro" value="{{$pro->id}}">
                                                    <h4 class="text-center">are you sure to delete ?</h4>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger waves-effect text-left" >Delete</button>
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
