@extends('layouts.manager')
@section('manager')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Leased</h4>
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
                                    <th>Tanant First Name</th>
                                    <th>Tanant Last Name</th>
                                    <th>Assign Name</th>
                                    <th>Trams</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>


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
                "ajax": "{{ route('get.manager.leasedproperty') }}",
                columns: [
                    { data: 'property.property_name', name: 'property.property_name' },
                    { data: 'tanant.first_name', name: 'tanant.first_name' },
                    { data: 'tanant.last_name', name: 'tanant.last_name' },
                    { data: 'assign_name', name: 'assign_name' },
                    { data: 'trems', name: 'trems' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'last_date', name: 'last_date' },
                ]
            });
        })
    </script>
@endsection
