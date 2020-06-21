@extends('layouts.user')
@section('css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('user')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">TRANSACTION HISTORY</h4>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Amount</th>
                                    <th>Created date</th>
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



@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>


        $(document).ready(function () {

            $('#itemtable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get.mytransaction') }}",
                columns: [
                    { data: 'tanant.first_name', name: 'tanant.first_name' },
                    { data: 'tanant.last_name', name: 'tanant.last_name' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'is_paid',
                        render: function(data) {
                            if(data == 1) {
                                return 'UnPaid'
                            }
                            else {
                                return 'Paid'
                            }

                        },
                        defaultContent: '<img src="http://www.blogsaays.com/wp-content/uploads/2014/02/no-user-profile-picture-whatsapp.jpg" alt="" img style="width:250px; height:260px">'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false,class : 'text-center'},
                ]
            });
        })
    </script>
@endsection
