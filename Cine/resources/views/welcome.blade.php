@extends('layouts.app')

@section('infoGeneral')

       

    <div class="row justify-content-center">
        @auth
        <p class="text-white">Bienvenidos, {{$user->name}}</p>
        @endauth
        
    
        @guest
            <p class="text-white">bienvenidos, invitado! No estas logeado...</p>
        @endguest
    </div>
    <div class="justify-content-center text-center ">
        <img src="/images/13818.jpg" alt="cartel bienvenidos a cinemania" id="welcome-page-img">
    </div>

    <div class="container mt-5 mb-5  justify-content-center" id="cartel">
        <!-- Si existen datos en la tabla de peliculas, muestra la tabla -->      
        @if(!$cines->isEmpty()) 
        <div class="container pt-3 pt-3" >
            <h1 class='text-center'>Disfruta nuestros cines</h1><br>
            <div class="row align-items-start">
                @foreach($cines as $cine)
                <div class="col-3">
                    <div class="mb-3">
                    <img src="/images/cine-images/{{$cine->foto}}" alt="una foto"  class="img-thumbnail float-left card-img-top">
                    </div>
                </div>
                <div class="col-3">
                    <h3 >{{$cine->nombre_pelicula}}</h3>
                    <p >Titulo: {{$cine->nombre_pelicula}} </p>
                    <p>Genero: {{$cine->genero}}</p>
                    <p>Año de edicion: {{$cine->anio}}</p>
                    <p>País: {{$cine->paisOrigen}}</p>
                    
                    @auth
                        @if($user->rol=='admin')
                            <p>Descripción: {{$cine->description}}</p>
                        @else
                            <a href="{{route('peliculas.show', $cine->id)}}" class='btn btn-warning'>Ver detalles</a>
                        @endif
                    @endauth
                    @guest
                        <a href="{{route('peliculas.show', $cine->id)}}" class='btn btn-warning'>Ver detalles</a>
                    @endguest  
                </div>
                @endforeach    
        
    </div>
    <!-- si tabla peliculas en bd esta vacia, muestra solo este mensaje -->
    @else
    <p class='text-center'>"Disculpa, servicio no está disponible ahora, intenta más tarde"</p> 
    @endif
</div>

@endsection

 <!-- footer -->
 @section("pie")

@endsection

