@extends("layouts.app")

<!-- Header -->
@section("cabezera")
<div class="container"></div>
@endsection
<!-- main -->
@section("infoGeneral")
<div class="container pt-5">
<div class="row align-items-start shadow-lg p-3 mb-5 bg-white rounded">
    <div class='col-sm-8 offset-sm-2'>
        <h2 class='text-center'>Modificar una pelicula</h2>
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
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('cines.update', $cine->id) }}" id="edit_cine"><!-- AdminCinesController@store -->
        @method('PATCH')
        @csrf
        <div class="row align-items-start">
            <div class="col">
                <div class="mb-3">
                    <label for="nombre_pelicula" class="form-label" >Nombre</label>
                    <input type="text" class="form-control" id="nombre_pelicula" name="nombre_pelicula" value="{{$cine->nombre_pelicula}}">   
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Genero</label>
                    <input type="text" class="form-control" id="genero" name="genero" value="{{$cine->genero}}">
                </div>
                <div class="mb-3">
                    <label for="anio" class="form-label">Año</label>
                    <input type="text" class="form-control" id="anio" name="anio" value="{{$cine->anio}}">
                </div>
                <div class="mb-3">
                    <label for="paisOrigen" class="form-label">País de origen</label>
                    <input type="text" class="form-control" id="paisOrigen" name="paisOrigen" value="{{$cine->paisOrigen}}">
                </div>
                <div class="mb-3">
                @if($cine->foto)
                    <img src="/images/cine-images/{{$cine->foto}}" alt="una foto" width="100px">
                @else
                    <img src="/images/imagen_no_disponible.png" alt="una foto" width="100px">
                @endif
                    <!-- <label for="foto" class="form-label">Imagen</label> -->
                    <input type="hidden" class="form-control" name="foto" value="{{$cine->foto}}">
                    <input type="file" class="form-control" name="foto" placeholder="foto">
                </div>
                <div class="row">
                    <p><strong>Atención:</strong> precio y plazos iguales para todos horas elegidas, si quieres distintas, tienes que introducir uno por uno.</p>
                    <div class="col-sm">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="{{$cine->consultarPrecio($cine->id)}}">
                    </div>
                    <div class="col-sm"><label for="plazos_libres" class="form-label">Plazos en venta</label>
                        <input type="text" class="form-control" id="plazos_libres" name="plazos_libres" value="{{$cine->consultarPlazos($cine->id)}}">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" rows="5" name="description">{{$cine->description}}</textarea>
                </div>
                <div class="row">
                    <p>Horario</p>
                    <!-- horario disponible (tabla Horario) -->
                    @if($horario->isEmpty())
                    <p class="text-danger"> ¡Antes de añadir una pelicula, debes rellenar tabla de horarios en la base de datos! </p> 
                    @else
                    @foreach($horario as $dia)
                    <div class="col-sm-3"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value='{{$dia->id}}' id='{{$dia->id}}' name="dia[]" 
                        @if($cine->isChecked($cine->id,$dia->id)) checked @endif />
                        <label class="form-check-label" for="dia">{{$dia->dia}} {{$dia->hora}}</label>
                    </div>     
                    </div>
                    @endforeach
                    
                    @endif
                </div>

        </div>
        
            </div>
            
        <input type="submit" name="enviar" value="Modificar" class='btn btn-warning btn-mio'>
        
        </form>
        <form method="post" action="{{ route('cines.destroy', $cine->id) }}">
        @csrf
        @method('DELETE')
        <input type="submit" name="enviar" value="Eliminar esta pelicula" class='btn btn-warning btn-mio'>
        </form>
        
</div>
</div>
@endsection
<!-- Footer -->
@section("pie")

@endsection