@extends("layouts.app")

<!-- Header -->
@section("cabezera")
<div class="container pt-3"></div>
@endsection
<!-- main -->
@section("infoGeneral")
<div>
        @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
       
        @endif
<div class="container pt-3">
<div class="row align-items-start shadow-lg pt-3 pb-3 mb-5 bg-white rounded">

        <h2 class='display-8 '>Añadir nueva pelicula</h2>
       
        <form method="post" enctype="multipart/form-data" action="{{route('cines.store')}}" id="create_cine">
            
        @csrf
        <div class="row align-items-start">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nombre_pelicula" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_pelicula" name="nombre_pelicula">
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Genero</label>
                    <input type="text" class="form-control" id="genero" name="genero">
                </div>
                <div class="mb-3">
                    <label for="anio" class="form-label">Año</label>
                    <input type="text" class="form-control" id="anio" name="anio">
                </div>
                <div class="mb-3">
                    <label for="paisOrigen" class="form-label">País de origen</label>
                    <input type="text" class="form-control" id="paisOrigen" name="paisOrigen">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="row">
                    <p class="text-danger"><strong>Atención:</strong> establece precio y plazos iguales para todos horas elegidas, si quieres distintas, tienes que introducir uno por uno.</p>
                    <div class="col-sm">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" title="establece precio y plazos iguales para todos horas elegidas">
                    </div>
                    <div class="col-sm"><label for="plazos_libres" class="form-label">Plazos en venta</label>
                        <input type="text" class="form-control" id="plazos_libres" name="plazos_libres"></div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" rows="5" name="description"></textarea>
                </div>
                <div class="row">
                    <p>Elige horario</p>
                    <!-- horario disponible (tabla Horario) -->
                    @if($horario->isEmpty())
                    <p class="text-danger"> ¡Antes de añadir una pelicula, debes rellenar tabla de horarios en la base de datos! </p> 
                    @else
                    @foreach($horario as $dia)
                    <div class="col-sm-3"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value='{{$dia->id}}' id='{{$dia->id}}' name="dia[]" /> <!--@checked(old('dia', $dia->active)) -->
                        <label class="form-check-label" for="dia">{{$dia->dia}} {{$dia->hora}}</label> 
                    </div>     
                    </div>
                    @endforeach
                    
                    @endif
                </div>
               
            </div>
       
        </div>
        <div class='row'>
            <input type="submit" name="enviar" value="Enviar" class='btn btn-warning btn-mio'>
            <input type="reset" name="limpiar" value="Limpiar" class='btn btn-outline-warning btn-mio'>
        </div>
        </form>
        </div></div>  
@endsection
<!-- Footer -->
@section("pie")

@endsection