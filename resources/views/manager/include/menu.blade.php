
<li> <a class="" href="{{route('manager.dashboard')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Dashboard <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>




<li> <a class="" href="{{route('manager.tanant.list')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Tanant List<span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>

<li> <a class="" href="{{route('manager.swimming.pool.list')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Swimming Pool Booking<span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-wrench"></i><span class="hide-menu">Property</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{route('manager.property.list')}}">Property List</a></li>
        <li><a href="{{route('manager.leased.property')}}">Leased Property</a></li>
        <li><a href="{{route('manager.unleased.property')}}">UnLeased Property</a></li>
        <li><a href="{{route('manager.assign.property')}}">Assign Property</a></li>
    </ul>
</li>

<li> <a class="" href="{{route('manager.transaction')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Transaction <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>


<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-wrench"></i><span class="hide-menu">Service Requests </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{route('manager.service.request.open')}}">Open</a></li>
        <li><a href="{{route('manager.service.request.close')}}">Closed</a></li>
    </ul>
</li>





