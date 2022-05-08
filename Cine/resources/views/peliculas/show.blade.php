@extends("layouts.app")

<!-- Header -->
@section("cabezera")

@endsection
<!-- main -->
@section("infoGeneral")
    <div class='container'>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <h2 class='text-center text-white pt-5 pb-3'>{{$cine->nombre_pelicula}}</h2>
        <div>
        @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        <br />
        @else
        

        <div class="row align-items-start shadow-lg p-3 mb-5 bg-white rounded">
            <div class="col-4">
                <div class="row">
                    @if($cine->foto)
                        <img src="/images/cine-images/{{$cine->foto}}" alt="una foto" class="card-img-top ">
                    @else
                        <img src="/images/imagen_no_disponible.png" alt="una foto" class="card-img-top">
                    @endif   
                </div>
            </div>
            <div class="col-8 mb-1">
                <div class="row">
                    <strong>Titulo: {{$cine->nombre_pelicula}}</strong>
                    <ul >
                        <li class="list-cinema">Genero: {{$cine->genero}}</li>
                        <li>Año de edicion: {{$cine->anio}}</li>
                        <li>Pais: {{$cine->paisOrigen}}</li>
                        <li>Descripción: {{$cine->description}}</li>
                        <li >Cuando: 
                            @foreach($horario as $dia)
                                <br><span class="pl-2">  {{$dia->consultHorario($dia->horario_id)}} {{$dia->hora}} {{$dia->precio}}€/pers</span>
                                @endforeach
                        </li>
                </ul>
                
                @if($cine->consultarPlazos($cine->id)<=1 || $horario->isEmpty())
                    <p>Etradas no están disponibles.</p>
                @else
                @auth
                <!-- <a href="/user/entradas/{{$cine->id}}" class='btn btn-warning btn-mio'>Quero ver!</a> -->
                <a href="/user/{{$user->id}}/entradas/{{$cine->id}}" class='btn btn-warning btn-mio'>Quero ver esta peli!</a>
               @endauth
               @guest
               <div class="border-top pt-3 mb-3">
                    <strong class="text-danger">No estás identificado, autenticación requerida para realizar pedido de entradas, por favor, inicia sesión o registrate</strong>
                    <div class='pt-3'>
                        <a href="/login" class='btn btn-warning btn-mio'>Iniciar sesión</a>
                        <a href="/register" class='btn btn-warning btn-mio'>Crear una cuenta</a>
                        <a href="/" class='btn btn-warning btn-mio'>Volver al inicio</a>
                    </div>
                </div>
               @endguest
            </div>
            
                @endif
    </div>  
              
          
   
        
    @endif 
@endsection
<!-- Footer -->
@section("pie")

@endsection