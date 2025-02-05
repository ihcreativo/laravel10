@auth
    @extends('layouts.app')
    @section('titulo')
        Ishevi - Control + 
    @endsection
    @section('contenido') 
        <div class="container-fluid"> 
            {{-- {{auth()->user()}} --}}
            <dashboard path="{{route('login.index')}}"></dashboard>
            {{-- <dashboard-inicio path_img="{{asset('/img/img/@')}}" path="{{route('login.index')}}"></dashboard-inicio> --}}
        </div>
    @endsection
@endauth


