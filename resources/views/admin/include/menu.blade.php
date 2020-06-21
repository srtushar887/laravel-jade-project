
<li> <a class="" href="{{route('admin.dashboard')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Dashboard <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>
<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-wrench"></i><span class="hide-menu">Properties</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{route('admin.property.list')}}">Property List</a></li>
        <li><a href="{{route('admin.leased.property')}}">Leased Property</a></li>
        <li><a href="{{route('admin.unleased.property')}}">UnLeased Property</a></li>
        <li><a href="{{route('admin.assign.property')}}">Assign Property</a></li>
    </ul>
</li>
<li> <a class="" href="{{route('admin.transaction')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Transaction <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>


<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-wrench"></i><span class="hide-menu">Users</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{route('admin.craate.user.role')}}">Create User Role</a></li>
        <li><a href="{{route('admin.create.user')}}">Create New User</a></li>
        <li><a href="{{route('admin.adminlist')}}">Admin List</a></li>
        <li><a href="{{route('admin.managerlist')}}">Manager List</a></li>
        <li><a href="{{route('admin.tanantlist')}}">Tanant List</a></li>
    </ul>
</li>
<li> <a class="" href="{{route('admin.swimming.pool.list')}}" ><i class="icon-speedometer"></i><span class="hide-menu">Swimming Pool Booking<span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-wrench"></i><span class="hide-menu">Service Requests </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{route('admin.service.request.open')}}">Open</a></li>
        <li><a href="{{route('admin.service.request.close')}}">Closed</a></li>
    </ul>
</li>

<li> <a class="" href="{{route('admin.general.settings')}}" ><i class="icon-speedometer"></i><span class="hide-menu">General Settings <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
</li>
