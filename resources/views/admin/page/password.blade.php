@extends('layouts.admin')
@section('admin')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{--<div class="card-header bg-info">--}}
                {{--<h4 class="m-b-0 text-white">Other Sample form</h4>--}}
                {{--</div>--}}
                <div class="card-body">
                    <form action="{{route('admin.password.change')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">Change Password</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="text" id="firstName" name="password" class="form-control" placeholder="Enter Site Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="text" id="firstName" name="c_password"  class="form-control" placeholder="Enter Site Sub Title">
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
