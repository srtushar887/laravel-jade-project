@extends('layouts.admin')
@section('admin')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- <div class="row page-titles">
             <div class="col-md-5 align-self-center">
                 <h4 class="text-themecolor">Admin Dashboard</h4>
             </div>

         </div> -->
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-home"></i></h3>
                                    <p class="text-muted">Avaliable Rentals</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="counter text-gray-dark">{{$available}}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-user-following"></i></h3>
                                    <p class="text-muted">Leased Properties</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="counter text-cyan">{{$leased_property}}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-people"></i></h3>
                                    <p class="text-muted">Total Tenants</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="counter text-cyan">{{$tanant}}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-wrench"></i></h3>
                                    <p class="text-danger">Open Service Requests</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="counter text-danger">{{$service}}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-sm-12">

                        <div class="white-box">
                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-captions" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example-captions" data-slide-to="1" class="active"></li>
                                    <li data-target="#carousel-example-captions" data-slide-to="2" class=""></li>
                                </ol>
                                <div role="listbox" class="carousel-inner">
                                    <div class="carousel-item"> <img src="/assets/admin/images/background/aptstan.jpg" alt="First slide image">
                                        <div class="carousel-caption">
                                            <h3 class="text-white font-600">Living the Good Life</h3>
                                            <p> Please visit our Lobby Area for more information. </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item active"> <img src="/assets/admin/images/background/pool.jpg" alt="Second slide image">
                                        <div class="carousel-caption">
                                            <h3 class="text-white font-600">Managers Workshop</h3>
                                            <p> For More information please visit HR</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item"> <img src="/assets/admin/images/background/aptstan.jpg" alt="Third slide image">
                                        <div class="carousel-caption">
                                            <h3 class="text-white font-600">Are your Residents Happy?</h3>
                                            <p> Read more with Mohannad </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                                <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                            </div></div>


                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-12">

                        <div class="white-box">

                            </h3>
                            <div class="row sales-report">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h2>Recent Payments - April 2019</h2>
                                    <p>TOTAL PAYMENTS FOR THIS MONTH</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 ">
                                    <h1 class="text-right text-success m-t-20">${{number_format($total_amount,2)}}</h1>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th width="89">NAME</th>
                                        <th width="124">LOCATION</th>
                                        <th width="69">STATUS</th>
                                        <th width="50">DATE</th>
                                        <th width="72">AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($as_pro_paid) > 0)
                                    @foreach($as_pro_paid as $payment)
                                    <tr>
                                        <td class="txt-oflo">
                                            @if(!empty($payment->tanant->first_name))
                                            {{$payment->tanant->first_name}}
                                            @else
                                                @if(!empty($payment->tanant->email))
                                                {{$payment->tanant->email}}
                                                    @endif
                                            @endif
                                                @if(!empty($payment->tanant->last_name))
                                                    {{$payment->tanant->last_name}}
                                                @endif
                                        </td>
                                        <td>{{$payment->property->property_name}}</td>
                                        <td>
                                            @if($payment->is_paid == 1)
                                            <span class="label label-megna label-rounded">UNPAID</span>
                                            @else
                                            <span class="label label-megna label-rounded">PAID</span>
                                                @endif
                                        </td>
                                        <?php
                                        $t = \Carbon\Carbon::parse($payment->created_at);
                                        ?>
                                        <td class="txt-oflo">{{$t->isoFormat('LLL')}}</td>
                                        <td>{{$payment->amount}} KWD</td>
                                    </tr>
                                        @endforeach
                                        @else
                                        <td colspan="5" class="text-center">No Data Available now </td>
                                    @endif

                                    </tbody>
                                </table>
                                <span class="label-megna label-rounded"><a href="{{route('admin.transaction')}}">Check all payments.</a> </span>
                            </div>
                        </div>

@endsection
