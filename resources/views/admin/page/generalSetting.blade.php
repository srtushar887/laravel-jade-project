@extends('layouts.admin')
@section('admin')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{--<div class="card-header bg-info">--}}
                {{--<h4 class="m-b-0 text-white">Other Sample form</h4>--}}
                {{--</div>--}}
                <div class="card-body">
                    <form action="{{route('admin.general.setting.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">General Setting</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Site Title</label>
                                        <input type="text" id="firstName" name="site_title" value="{{$gn->site_title}}" class="form-control" placeholder="Enter Site Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Preloader Name</label>
                                        <input type="text" id="firstName" name="site_sub_title" value="{{$gn->site_sub_title}}" class="form-control" placeholder="Enter Site Sub Title">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Site Email</label>
                                        <input type="text" id="firstName" name="site_email" value="{{$gn->site_email}}"  class="form-control" placeholder="Enter Site Email">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Site Phone Number</label>
                                        <input type="text" id="firstName" name="site_number" value="{{$gn->site_number}}" class="form-control" placeholder="Enter Site Phone Number">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Site Icon</label>
                                        <img src="{{asset($gn->site_icon)}}" style="height: 100px;width: 100%">
                                        <input type="file" id="firstName" name="site_icon" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Site Logo</label>
                                        <img src="{{asset($gn->site_logo)}}" style="height: 100px;width: 100%">
                                        <input type="file" id="firstName" name="site_logo" class="form-control" placeholder="John doe">
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
