@extends('layouts.admin')
@section('admin')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Create Tanant</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">

                    {{--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back</button>--}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form" action="{{route('admin.user.save')}}" method="post">
                            @csrf

                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="example-month-input2" class=" col-form-label">User Role</label>
                                    <select class="custom-select " id="example-month-input2" name="role">
                                        <option selected="" value="0">Choose...</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-month-input2" class=" col-form-label">Account Type</label>
                                    <select class="custom-select " id="example-month-input2" name="account_type">
                                        <option selected="" value="0">Choose...</option>
                                            <option value="2">Active</option>
                                            <option value="1">InActive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">First Name</label>
                                    <input class="form-control" name="first_name" type="text" placeholder="Enter First Name"  id="example-text-input">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">Last Name</label>
                                    <input class="form-control" name="last_name" type="text" placeholder="Enter Last Name"  id="example-text-input">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">User Name</label>
                                    <input class="form-control" name="user_name" type="text" placeholder="Enter User Name"  id="example-text-input">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">Email</label>
                                    <input class="form-control" name="email" type="text" placeholder="Enter Email"  id="example-text-input">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">Password</label>
                                    <input class="form-control" name="password" type="text" placeholder="Enter Password"  id="example-text-input">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class=" col-form-label">Password</label>
                                    <textarea class="form-control" name="message" type="text" placeholder="Enter Password"  id="example-text-input"></textarea>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
