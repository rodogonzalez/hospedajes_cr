{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>



<li class="nav-item"><a class="nav-link" href="{{ backpack_url('hosting-provider') }}"><i class="nav-icon la la-question"></i> Hospedajes</a></li>
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('hosting-offer') }}"><i class="nav-icon la la-question"></i> Hosting offers</a></li> !-->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tour') }}"><i class="nav-icon la la-question"></i> Tours</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('airline') }}"><i class="nav-icon la la-question"></i> Aerolineas</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('rent-a-car') }}"><i class="nav-icon la la-question"></i> Rent a Cars</a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Parametros</a>
    <ul class="nav-dropdown-items">

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country') }}"><i class="nav-icon la la-question"></i> Paises</a></li>
        
        
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country-part') }}"><i class="nav-icon la la-question"></i> Country parts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country-parts-destination') }}"><i class="nav-icon la la-question"></i> Country parts destinations</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('hosting-feature') }}"><i class="nav-icon la la-question"></i> Caracteristica de Hospedaje</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tour-activity-type') }}"><i class="nav-icon la la-question"></i> Actividades de Tour</a></li>
        


    </ul>
</li>



<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Admin</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
    </ul>
</li>
