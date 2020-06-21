@extends('layouts.manager')
@section('css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('manager')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Property</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">

                </div>
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
                                    <th>Property</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="property-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('admin.property.delete')}}" method="post">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Delete property</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delete_property" class="del_pro">
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
                "ajax": "{{ route('get.transa.manager') }}",
                columns: [
                    { data: 'tanant.first_name', name: 'tanant.first_name' },
                    { data: 'tanant.last_name', name: 'tanant.last_name' },
                    { data: 'property.property_name', name: 'property.property_name' },
                    { data: 'property.monthly_fee', name: 'property.monthly_fee' },
                    {
                        data: 'is_paid',
                        render: function(data) {
                            if(data == 1) {
                                return 'Unpaid'
                            }else if(data == 2){
                                return 'Paid'
                            }
                            else {
                                return 'Not Set'
                            }

                        },
                        defaultContent: '<img src="http://www.blogsaays.com/wp-content/uploads/2014/02/no-user-profile-picture-whatsapp.jpg" alt="" img style="width:250px; height:260px">'
                    },
                ]
            });
        })
    </script>
@endsection
