@extends('layouts.user')
@section('css')

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
        <div class="col-lg-12">
            <div class="card">
                {{--<div class="card-header bg-info">--}}
                {{--<h4 class="m-b-0 text-white">Other Sample form</h4>--}}
                {{--</div>--}}
                <div class="card-body">
                    <form action="{{route('user.payment.create')}}" method="post" >
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">Payment</h3>
                            <hr>
                            <div class="row p-t-20">

{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="control-label">Enter Amount</label>--}}
{{--                                        <input type="number" id="firstName" name="amount" class="form-control" placeholder="Enter Amount">--}}
{{--                                        <small class="form-control-feedback">  </small> </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="amount" value="{{$assign}}" checked>Due ${{$assign}}</label>
                                        </div>
                                </div>
                                </div>

                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Payment</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSACTION HISTORY</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-responsive m-t-40">
                        <table id="example23"
                               class="display nowrap table table-hover table-striped table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Result</th>
                                <th>Amount</th>
                                <th>Track ID</th>
                                <th>Payment ID</th>
                                <th>Transaction ID</th>
                                <th>Created date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Result</th>
                                <th>Amount</th>
                                <th>Track ID</th>
                                <th>Payment ID</th>
                                <th>Transaction ID</th>
                                <th>Created date</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($transantion_history as $trns)
                                <tr>
                                    <td>

                                            {{$trns->result}}

                                    </td>
                                    <td>

                                            {{$trns->amt}} KWD


                                    </td>
                                    <td>

                                            {{$trns->trackid}}


                                    </td>
                                    <td>

                                            {{$trns->paymentid}}


                                    </td>
                                    <td>

                                            {{$trns->tranid}}


                                    </td>
                                    <td>{{$trns->created_at}}</td>
                                    <td>
                                        @if($trns->status == 1)
                                            UnPaid
                                        @else
                                            Paid
                                        @endif

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
