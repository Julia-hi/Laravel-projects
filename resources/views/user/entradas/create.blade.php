@extends("layouts.app")

<!-- Header -->
@section("cabezera")

@endsection
<!-- main -->
@section("infoGeneral")

    <div class='container'>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
           <p class="text-white">{{ session('status') }}</p> 
        </div>
    @endif
        <h2 class='text-center text-white pt-5 pb-3'>Comprar entradas al cine: {{$cine->nombre_pelicula}}</h2>
        <div>
        @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif

        <div class="row align-items-start shadow-lg p-3 mb-5 bg-white rounded">
            <div class="col-4">
                <div class="row">
                        <img src="/images/asientos.jpg" alt="imagen de asientos" width='50'>
                </div>
            </div>
            <div class="col-8 mb-1">
                <div class="row">
                    <h1 >Titulo: {{$cine->nombre_pelicula}} ({{$cine->genero}})</h1>
                   
                 
                @if($cine->consultarPlazos($cine->id)<=1 || $horario->isEmpty())
                    <p>Etradas no están disponibles.</p>
                @else  
            </div>
                    <strong>Realizar pedido</strong>
                    <p>Nota: por su seguridad la maxima cantidad de entradas es 10</p>
                <form method="post" action="{{ route('user.entradas.store', $cine->id) }}" id="pedido"> 
                @csrf
                    <div class="row">
                        <div class="col-sm-3 pb-3"> 
                        @auth
                            <input type="hidden" id="cine_id" name="cine_id" value="{{$cine->id}}">
                            <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">  
                        @endauth
                            <label for="fecha_id" class="form-label">Elige la entrada:</label>
                            <select name="fecha_id" id="fecha_id" class="form-control">
                                <option value='' selected>elige el dia y hora</option>
                                @foreach($horario as $dia)
                                <option value="{{$dia->id}}">{{$dia->consultHorario($dia->horario_id)}} {{$dia->hora}} {{$dia->precio}}€/pers</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                        <label for="entradas" class="form-label" >Asientos:</label>
                        <input type="text" class="form-control" id="entradas" name="entradas" title="cantidad de entradas">   
                    </div>
                    </div> 

                    @auth
                    <div class="row"> 
                        <button type="submit" class="btn btn-warning btn-mio">Comprar</button>
                    </div>
                    @endauth
                </form>
                @guest
                <div class="border-top pt-3 mb-3">
                    <strong class="text-danger display-6 ">No estás identificado, autenticación requerida para realizar pedido de entradas</strong>
                    <div class='pt-3'>
                        <a href="/login" class='btn btn-warning btn-mio'>Iniciar sesión</a>
                        <a href="/register" class='btn btn-warning btn-mio'>Crear una cuenta</a>
                        <a href="/" class='btn btn-warning btn-mio'>Volver al inicio</a>
                    </div>
                </div> 
                @endguest 
            </div>

                @endif
                     
@endsection
<!-- Footer -->
@section("pie")

@endsection