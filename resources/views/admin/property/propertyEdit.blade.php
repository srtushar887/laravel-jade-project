@extends('layouts.admin')
@section('admin')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Update Property</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">

                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form" action="{{route('admin.property.update')}}" method="post">
                            @csrf
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Property Name</label>
                                <div class="col-10">
                                    <input type="hidden" name="id" value="{{$edit_property->id}}">
                                    <input class="form-control" name="property_name" value="{{$edit_property->property_name}}" type="text" placeholder="Enter Property Name"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Property Address</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="property_address" cols="5" rows="5" type="text" placeholder="Enter Property Address"  id="example-text-input">{!! $edit_property->property_address !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Property Description</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="property_description" cols="5" rows="5" type="text" placeholder="Enter Property Description"  id="example-text-input">{!! $edit_property->property_description !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Monthly Fee</label>
                                <div class="col-10">
                                    <input class="form-control" name="monthly_fee" value="{{$edit_property->monthly_fee}}" type="number" placeholder="Enter Monthly Fee"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Let Fee</label>
                                <div class="col-10">
                                    <input class="form-control" name="let_fee" type="number" value="{{$edit_property->let_fee}}" placeholder="Enter Let Fee"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Deposit Fee</label>
                                <div class="col-10">
                                    <input class="form-control" name="deposit_fee" type="number" value="{{$edit_property->deposit_fee}}" placeholder="Enter Deposit Fee"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Property Style</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_style" value="{{$edit_property->property_style}}" type="text" placeholder="Enter Property Style"  id="example-text-input">
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="example-month-input2" class="col-2 col-form-label">Pets Allowed</label>
                                <div class="col-10">
                                    <select class="custom-select col-12" id="example-month-input2" name="pet_allow">
                                        <option selected="" value="0">Choose...</option>
                                        <option value="1" {{$edit_property->pet_allow == 1 ? 'selected' : '' }}>yes</option>
                                        <option value="2" {{$edit_property->pet_allow == 2 ? 'selected' : '' }}>no</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Year Built</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_year_build" value="{{$edit_property->property_year_build}}" type="text" placeholder="Enter Year Built"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Property Size</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_size" value="{{$edit_property->property_size}}" type="text" placeholder="Enter Property Size"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Total Bedrooms</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_bedroom" value="{{$edit_property->property_bedroom}}" type="text" placeholder="Enter Total Bedrooms"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Total Bathrooms</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_bathroom" value="{{$edit_property->property_bathroom}}" type="text" placeholder="Enter Total Bathrooms"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Parking Type</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_parking_type" value="{{$edit_property->property_parking_type}}" type="text" placeholder="Enter Parking Type"  id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label"> Heating/Air Conditioning</label>
                                <div class="col-10">
                                    <input class="form-control" name="property_air_con" value="{{$edit_property->property_air_con}}" type="text" placeholder="Enter Heating/Air Conditioning"  id="example-text-input">
                                </div>
                            </div>

                            <div class="form-group mt-5 row">
                                <label for="example-text-input" class="col-2 col-form-label">Google Map Embed URL</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="property_google_map" cols="5" rows="5" type="text" placeholder="Enter Google Map Embed URL"  id="example-text-input">{!! $edit_property->property_google_map !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-month-input2" class="col-2 col-form-label">Status</label>
                                <div class="col-10">
                                    <select class="custom-select col-12" id="example-month-input2" name="status">
                                        <option selected="" value="0">Choose...</option>
                                        <option value="1" {{$edit_property->status == 1 ? 'selected' : '' }}>Publish</option>
                                        <option value="2" {{$edit_property->status == 2 ? 'selected' : '' }}>Unpublish</option>
                                    </select>
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
