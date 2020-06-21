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
                                    <th>User First Name</th>
                                    <th>User Last Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
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


    <div class="modal fade" id="manager-booking" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('manager.booking.save')}}" method="post">
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
                            <input type="hidden" name="booking_id" class="bookingid">
                            <select class="form-control" name="action">
                                <option value="0">select any</option>
                                <option value="1">Confirm</option>
                                <option value="2">Reject</option>
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

        function mangerbooking(id) {
            $('.bookingid').val(id);
        }



        $(document).ready(function () {

            $('#itemtable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get.manager.bookinglist') }}",
                columns: [
                    { data: 'user.first_name', name: 'user.first_name' },
                    { data: 'user.last_name', name: 'user.last_name' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    {
                        data: 'status',
                        render: function(data) {
                            if(data == 1) {
                                return 'Pending'
                            }else if (data == 2){
                                return 'Confirmed'
                            }
                            else if (data == 3){
                                return 'Rejected'
                            }
                            else {
                                return 'Urgent'
                            }

                        },

                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });
        })
    </script>
@endsection
