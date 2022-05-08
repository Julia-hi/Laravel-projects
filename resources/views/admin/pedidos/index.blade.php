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
    <h3 class='text-center'>Lista de pedidos</h3>
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
        @if(!$pedidos->isEmpty()) 
        
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-center">Id</th>
              <th scope="col" class="text-center">User id</th>
              <th scope="col" class="text-center">Pelicula id</th>
              <th scope="col" class="text-center">Nombre de pelicula</th>
              <th scope="col" class="text-center">Num entradas</th>
              <th scope="col" >Pagado,€</th>
              <th scope="col" class="text-center">Creado</th>
              <th scope="col" class="text-center">Modificado</th>
            </tr>
          </thead>
          <tbody>
            <!-- bucle para recorrer filas de tabla -->
            @foreach($pedidos as $pedido)
            <tr>
              <th scope="row" >{{$pedido->id}}</th>
              <td class="text-center">{{$pedido->users_id}}</td>
              <td class="text-center">{{$pedido->peliculas_id}}</td>
              <td class="text-center">{{$pedido->consultarCine($pedido->peliculas_id)}}</td>
              <td class="text-center">{{$pedido->entradas}}</td>
              <td >{{$pedido->coste}}</td>
              <td class="text-center">{{$pedido->created_at}}</td>
              <td class="text-center">{{$pedido->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h3 class="text-center">Resumen:</h3>
       <table class="table">
        <thead>
            <tr>
              <th class="text-center">Total pagado,€ </th>
              <th class="text-center">Entradas vendidas</th>
              <th class="text-center">Pelicula más popular</th>
              <th class="text-center">Pelicula menos popular</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">{{ $pedido->sumaCostes() }}</td>
            <td class="text-center">{{ $pedido->sumaEntradas() }}</td>
            <td class="text-center">{{ $pedido->masPopular() }}</td>
            <td class="text-center">{{ $pedido->menosPopular() }}</td>
          </tr>
        </tbody>
       </table>

        <!-- si no hay filas en la tabla, muestra solo este mensaje -->
        @else
            <h3 class='text-center align-middle text-danger'>Todavia no hay pedidos</h3>
        @endif
        @if($user && $user->rol!="admin")
        <h2 class='text-center'>Acceso solo para administrador</h2>
        @endif 
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
