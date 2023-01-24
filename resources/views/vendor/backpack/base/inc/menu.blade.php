{{-- =================================================== --}}
{{-- ========== Top menu items (ordered left) ========== --}}
{{-- =================================================== --}}
<ul class="nav navbar-nav d-md-down-none">

    @if (backpack_auth()->check())
        {{-- Topbar. Contains the left part --}}
        @include(backpack_view('inc.topbar_left_content'))

    @else
    <style>
.class_menu {
    display:inline-flex;
}

    </style>
        <ul>

            <li class="class_menu">¿Quienes Somos?</li>
            <li class="class_menu"><a href="/new-host">Anunciate</a></li>
            <li class="class_menu"><a href='/admin'>Mi Cuenta</a></li>
            <li class="class_menu">
                <select id="current_country" onchange="pull_country_parts(this.value)">
                    @foreach ($paises as $pais)
                    <option value='{{$pais["slug"]}}'>{{$pais["name"]}}</option>
                    @endforeach
                </select>
                <select id="country_part"  onchange="pull_country_parts_destinations (document.getElementById('current_country').selectedOptions[0].value, this.value)" sxxtyle="display:none"></select>
            </li>      
        </ul>
    @endif

</ul>
{{-- ========== End of top menu left items ========== --}}



{{-- ========================================================= --}}
{{-- ========= Top menu right items (ordered right) ========== --}}
{{-- ========================================================= --}}
<ul class="nav navbar-nav ml-auto @if(config('backpack.base.html_direction') == 'rtl') mr-0 @endif">

    
    
    @if (backpack_auth()->guest())
        <li class="nav-item"><a class="nav-link" href="{{ route('backpack.auth.login') }}">{{ trans('backpack::base.login') }}</a>
        </li>
        @if (config('backpack.base.registration_open'))
            <li class="nav-item"><a class="nav-link" href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register') }}</a></li>
        @endif
    @else
        {{-- Topbar. Contains the right part --}}
        @include(backpack_view('inc.topbar_right_content'))
        @include(backpack_view('inc.menu_user_dropdown'))
    @endif
</ul>
{{-- ========== End of top menu right items ========== --}}
