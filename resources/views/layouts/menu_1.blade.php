<li class="menu {{ ! Route::is('dashboard') ?: 'active'}}">
    <a href="{{route('dashboard')}}" aria-expanded="false" class="dropdown-toggle">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>DashBoard</span>
        </div>
    </a>
</li>
<li class="menu {{! Route::is('users','usuariosAdd','usuarioX','changePasswordGet') ?: 'active'}}">
    {{-- <a href="{{route('users')}}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <span>Mis usuarios</span>
        </div>
    </a> --}}
</li>    
{{-- <li class="menu {{ ! Route::is('users','usuariosAdd,','usuarioX')?: 'badge-light-primary rounded-2 mx-3'}}">
    <a href="{{route('users')}}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <img src="{{ asset('img/ico/users.png')}}" width="24px">
            <span>Usuarios</span>
        </div>
    </a>
</li> --}}


{{-- <li class="menu {{ ! Route::is('dashboard') ?: 'badge-light-primary rounded-2 mx-3'}}">
    <a href="{{route('dashboard')}}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <img src="{{ asset('img/ico/home.png')}}" width="24px">
            <span>Inicio</span>
        </div>
    </a>
</li> --}}
<li class="menu {{ ! Route::is('setting') ?: 'badge-light-primary rounded-2 mx-3'}}">
    <a href="" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <img src="{{ asset('img/ico/setting.png')}}" width="24px">
            <span>Configuración</span>
        </div>
    </a>
</li>
