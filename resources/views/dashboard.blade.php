@auth
    @extends('layouts.app')
    @section('titulo')
        Morfee - Ausentismo 
    @endsection
    @section('contenido') 
        <div class="container-fluid"> 
            {{auth()->user()}}
            <mainapp></mainapp>
           {{-- <dashboard-inicio path_img="{{asset('/img/img/@')}}" path="{{route('login.index')}}"></dashboard-inicio> --}}
        </div>
    @endsection
@endauth


