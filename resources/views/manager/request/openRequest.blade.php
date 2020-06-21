@extends('layouts.manager')
@section('css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('manager')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Active Request</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="itemtable" >
                                <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Request</th>
                                    <th>Priority</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date Submitted</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="manager-open-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('manager.request.status.save')}}" method="post">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Manage Request</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select Action</label>
                            <input type="hidden" name="request_id" class="requestid">
                            <select class="form-control" name="action">
                                <option value="0">select any</option>
                                <option value="1">Processing</option>
                                <option value="2">Close</option>
                            </select>
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
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>

        function manageropenrequest(id) {
            $('.requestid').val(id);
        }



        $(document).ready(function () {

            $('#itemtable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get.manager.active.request') }}",
                columns: [
                    { data: 'property.property_name', name: 'property.property_name' },
                    { data: 'request_title', name: 'request_title' },
                    {
                        data: 'sel_priority',
                        render: function(data) {
                            if(data == 1) {
                                return 'Normal'
                            }else if (data == 2){
                                return 'Important'
                            }
                            else {
                                return 'Urgent'
                            }

                        },

                    },
                    { data: 'request_des', name: 'request_des' },
                    {
                        data: 'status',
                        render: function(data) {
                            if(data == 0) {
                                return 'Submited'
                            }else if (data == 1){
                                return 'Inprocess'
                            }else if (data == 2){
                                return 'Complete'
                            }
                            else {
                                return 'Urgent'
                            }

                        },

                    },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        })
    </script>
@endsection
