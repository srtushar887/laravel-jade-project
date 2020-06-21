@extends('layouts.manager')
@section('manager')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Assign Property</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('manager.save.assign.property')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">

                                <div class="row p-t-20">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Property</label>
                                            <select class="form-control custom-select selpro" name="property_id">
                                                <option value="0">--select any--</option>
                                                @foreach($property as $pro)
                                                    <option value="{{$pro->id}}">{{$pro->property_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Tanant</label>
                                            <select class="form-control custom-select selpro" name="tanants_id">
                                                <option value="0">--select any--</option>
                                                @foreach($user as $tan)
                                                    <option value="{{$tan->id}}">{{$tan->first_name}} {{$tan->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Trams</label>
                                            <input type="text" id="firstName" name="trems" class="form-control" placeholder="Enter Trams">
                                            <small class="form-control-feedback">  </small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Amount</label>
                                            <input type="number" id="firstName" name="amount" class="form-control" placeholder="Enter Trams">
                                            <small class="form-control-feedback">  </small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Start Date</label>
                                            <input type="date" id="firstName" name="start_date" class="form-control" placeholder="Enter Site Title">
                                            <small class="form-control-feedback">  </small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">End Date</label>
                                            <input type="date" id="firstName" name="last_date" class="form-control" placeholder="Enter Site Title">
                                            <small class="form-control-feedback">  </small> </div>
                                    </div>




                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
