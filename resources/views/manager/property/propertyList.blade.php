@extends('layouts.manager')
@section('css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('manager')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Property List</h4>
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
                                    <th>Property Name</th>
                                    <th>Property Address</th>
                                    <th>Status</th>
                                    <th class="text-nowrap">Action</th>
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


        function deletemanu(id) {
            $('.del_pro').val(id);
        }


        $(document).ready(function () {

            $('#itemtable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get.manager.propertylist') }}",
                columns: [
                    { data: 'property_name', name: 'property_name' },
                    { data: 'property_address', name: 'property_address' },
                    {
                        data: 'status',
                        render: function(data) {
                            if(data == 1) {
                                return 'publish'
                            }
                            else {
                                return 'unpublish'
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
