@extends('layouts.user')
@section('user')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{--<div class="card-header bg-info">--}}
                {{--<h4 class="m-b-0 text-white">Other Sample form</h4>--}}
                {{--</div>--}}
                <div class="card-body">
                    <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">Profile</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" id="firstName" name="first_name" value="{{$user->first_name}}" class="form-control" placeholder="Enter Site Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" id="firstName" name="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Enter Site Sub Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User Name</label>
                                        <input type="text" id="firstName" name="user_name" value="{{$user->user_name}}" class="form-control" placeholder="Enter Site Sub Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" id="firstName" name="email" value="{{$user->email}}"  class="form-control" placeholder="Enter Site Email">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" id="firstName" name="phone_number" value="{{$user->phone_number}}" class="form-control" placeholder="Enter Site Phone Number">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Alt Phone Number</label>
                                        <input type="text" id="firstName" name="alt_phone_number" value="{{$user->alt_phone_number}}" class="form-control" placeholder="Enter Site Phone Number">
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
