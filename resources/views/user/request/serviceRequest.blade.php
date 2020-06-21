@extends('layouts.user')
@section('user')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{--<div class="card-header bg-info">--}}
                {{--<h4 class="m-b-0 text-white">Other Sample form</h4>--}}
                {{--</div>--}}
                <div class="card-body">
                    <form action="{{route('user.create.request.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">NEW SERVICE REQUEST</h3>
                            <hr>
                            <div class="row p-t-20">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Property</label>
                                        <select class="form-control custom-select selpro" name="sel_propety">
                                            <option value="0">--select any--</option>
                                            @foreach($user_property as $pro)
                                                <option value="{{$pro->property->id}}">{{$pro->property->property_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Request Title</label>
                                        <input type="text" id="firstName" name="request_title" class="form-control" placeholder="Enter Request Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="form-control custom-select" name="sel_priority">
                                            <option value="0">--select any--</option>
                                            <option value="1">Normal</option>
                                            <option value="2">Important</option>
                                            <option value="3">Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Request Description</label>
                                        <textarea type="text" id="firstName" cols="5" rows="5" name="request_des" class="form-control" placeholder="Enter Request Description"></textarea>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>

                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
