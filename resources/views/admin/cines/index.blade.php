<!-- ZONA DE ADMINISTRADOR -->

@extends("layouts.app")
@section("cabezera")

@endsection

@section("infoGeneral")
<div class="container pt-5">
<div class="row align-items-start shadow-lg p-3 mb-5 bg-white rounded">
  @auth
    @if($user->rol=="admin")
    <h2 class='text-center' >ZONA DE ADMINISTRADOR</h2>
    <h3 class='text-center'>Modificar y eliminar peliculas</h3>
    @endif 
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
        <!-- Si existen datos en la tabla de peliculas, muestra la tabla -->      
        @if(!$cines->isEmpty()) 
        
        <table class="table">
          <thead>
            <tr>
              <th ></th>
              <th scope="col" class="text-center">Id</th>
              <th scope="col" class="text-center">Nombre</th>
              <th scope="col" class="text-center">Genero</th>
              <th scope="col" class="text-center">Año</th>
              <th scope="col" class="text-center">País de origen</th>
              <th scope="col" class="text-center">Descripción</th>
              <th scope="col" class="text-center">Horario</th>
              <th scope="col" class="text-center">Precio, €</th>
              <th scope="col" class="text-center">Foto</th>
              <th scope="col" class="text-center">Creado</th>
              <th scope="col" class="text-center">Modificado</th>
            </tr>
          </thead>
          <tbody>
            <!-- bucle para recorrer filas de tabla -->
            @foreach($cines as $cine)
            <tr>
              <th scope="row" >
                <a href="{{route('cines.edit', $cine->id)}}" class='btn btn-warning btn-mio'>Modificar</a>
                <form method="post" action="{{ route('cines.destroy', $cine->id) }}">
                  @csrf
                  @method('DELETE')
                  <!-- botón para eliminar una fila de tabla -->
                  <input type="submit" name="enviar" value="Eliminar" class='btn btn-warning btn-mio'>
                </form>  
              </th>
              <th scope="row" >{{$cine->id}}</th>
                <td class="text-center">{{$cine->nombre_pelicula}}</td>
                <td class="text-center">{{$cine->genero}}</td>
                <td class="text-center">{{$cine->anio}}</td>
                <td class="text-center">{{$cine->paisOrigen}}</td>
                <td>{{$cine->description}}</td>
                <!-- columna de horario --> 
                <td><ul>@foreach($cine->horario as $hora)
                  <li>{{$hora->dia}} {{$hora->hora}}</li>
                  @endforeach</ul>
                </td>
                <td class="text-center">
                  @foreach($cine->horario as $precio)
                  {{$precio->pivot->precio}}<br>
                  @endforeach
                </td>
               
                <!-- columna de horario -->
                @if($cine->foto)
                  <td><img src="/images/cine-images/{{$cine->foto}}" alt="una foto" width="100px"></td>
                @else
                  <td><img src="/images/imagen_no_disponible.png" alt="una foto" width="100px"></td>
                @endif
                <td class="text-center">{{$cine->created_at}}</td>
                <td class="text-center">{{$cine->updated_at}}</td>
                
              </tr>
            @endforeach
          </tbody>
        </table>


        <!-- si no hay filas en la tabla, muestra solo este mensaje -->
        @else
            <h3 class='text-center align-middle text-danger'>Todavia no hay peliculas en la base de datos</h3>
        @endif
        <!-- @if($user && $user->rol!="admin")
        <h2 class='text-center'>Acceso solo para administrador</h2>
        @endif  -->
        @endauth
        @guest
          <h2 class='text-center'>No estas logeado, acceso denegado</h2>
        @endguest
        </div>  
        </div>  
      @endsection
      <!-- footer -->
      @section("pie")

      @endsection
