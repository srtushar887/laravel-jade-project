@extends('layouts.manager')
@section('manager')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Tanant List</h4>
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
                                    <th>User Name</th>
                                    <th>Email</th>
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


    <div class="modal fade" id="manager-tatantlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('admin.tanant.details.update')}}" method="post">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Admin Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="hidden" name="user_edit_id" class="form-control admineditid">
                                <input type="text" name="first_name" class="form-control fname">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control lname">
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Name</label>
                                <input type="text" name="user_name" class="form-control uname">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control email">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control pnumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Account Type</label>
                                <select class="custom-select accounttype" id="example-month-input2" name="account_type">
                                    <option selected="" value="0">Choose...</option>
                                    <option value="2">Active</option>
                                    <option value="1">InActive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal">Close</button>
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
        function managertanantdetails(id)
        {
            var id = id;
            $.ajax({
                type : "POST",
                url : "{{route('get.single.managertanantdetails')}}",
                data : {
                    '_token' : "{{csrf_token()}}",
                    'id' : id,
                },
                success:function (data) {

                    $('.admineditid').val(id);
                    $('.fname').val(data.first_name);
                    $('.lname').val(data.last_name);
                    $('.uname').val(data.user_name);
                    $('.email').val(data.email);
                    $('.pnumber').val(data.phone_number);
                    $('.accounttype').val(data.account_type);

                }
            });
        }

        $(document).ready(function () {

            $('#itemtable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get.manager.tanantlist') }}",
                columns: [
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'email', name: 'email' },
                    {
                        data: 'account_type',
                        render: function(data) {
                            if(data == 1) {
                                return 'InActive'
                            }
                            else {
                                return 'Active'
                            }

                        },
                        defaultContent: '<img src="http://www.blogsaays.com/wp-content/uploads/2014/02/no-user-profile-picture-whatsapp.jpg" alt="" img style="width:250px; height:260px">'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@endsection
