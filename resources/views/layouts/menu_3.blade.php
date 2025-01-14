<li class="menu {{ ! Route::is('dashboard') ?: 'active'}}">
    <a href="{{route('dashboard')}}" aria-expanded="false" class="dropdown-toggle">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>DashBoard</span>
        </div>
    </a>
</li>

<li class="menu {{! Route::is('personal','empresarial','impacto','ubicacion','periodo') ?: 'active'}}">
    <a href=""  class="dropdown-toggle"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            <span> Caracterizaciones</span>
        </div>
    </a>   
    <div class="dropdown-menu py-3 px-1 widget-content widget-content-area bg-gray text-white" aria-labelledby="btndefault">    
        <a href="{{route('personal')}}" class="dropdown-item rounded py-2 small">
            <i class="fa-solid fa-user"></i>
            Caracterizacion personal
        </a>
        <a href="{{route('empresarial')}}" class="dropdown-item rounded py-2 small">
            <i class="fa-solid fa-building"></i>
            Caracterización empresarial
        </a>
        <a href="{{route('periodo')}}" class="dropdown-item rounded py-2 small">
            <i class="fa-solid fa-clock"></i>
            Periodo de tiempo
        </a>
        <a href="{{route('ubicacion')}}" class="dropdown-item rounded py-2 small">
            <i class="fa-solid fa-location-dot"></i>
            Ubicación geográfica
        </a>
        <a href="{{route('impacto')}}" class="dropdown-item rounded py-2 small">
            <i class="fa-solid fa-coins"></i>
            Impacto económico
        </a>
    </div>  
</li>  
<li class="menu menu-heading h-auto mt-3">
    <div class="heading py-0 my-0 mt-0 pt-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        <span>SETTING</span>
    </div>
</li>
<li class="menu {{! Route::is('users','usuariosAdd','usuarioX','changePasswordGet') ?: 'active'}}">
    <a href="{{route('users')}}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <span>Mis usuarios</span>
        </div>
    </a>
</li>    
<li class="menu {{ ! Route::is('setting') ?: 'active'}}">
    <a href="{{route('setting')}}" aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fa-solid fa-gears"></i>
            <span>Mi empresa</span>
        </div>
    </a>
</li>

<li class="menu menu-heading h-auto mt-3">
    <div class="heading py-0 my-0 mt-0 pt-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        <span>IMPORTACIONES</span>
    </div>
</li>
<li class="menu {{ ! Route::is('importar') ?: 'active'}}">
    <a href="{{route('importar')}}" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <i class="fa-solid fa-upload"></i>
            <span>Carga de archivos</span>
        </div>
    </a>
</li>

