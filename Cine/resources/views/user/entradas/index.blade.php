@extends('layouts.app')

@section('infoGeneral')

<div class="justify-content-center pt-5 pb-5">
  <div class="container bg-white full-screen pt-3 pb-3">
    <div class="row justify-content-center">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if($user->rol=='cliente')
        <!-- ZONA DE CLIENTE -->
      <div class="px-3 py-3">
        <div class="d-flex justify-content-center align-items-center">
        <img src="/images/cliente.jpg" alt="" width="100px" class="zona-image">
        <h1 class='text-center pt-0 mt-0 mx-5'>ZONA DE CLIENTE</h1>
        <img src="/images/film.jpg" alt="icono de cineman" width="100px" class="zona-image">
        </div>
    
        @if($user->consultarPedidos($user->id)>0)
    
        <h2 class="text-center">Lista de pedidos</h2>
        <table class="table ">
          <thead>
            <tr>
              
              <th scope="col" class="text-center">Id</th>
              <th scope="col" max-width="300px">Nombre pelicula</th>
              <th scope="col" class="text-center">Dia y hora</th>
              <th scope="col" class="text-center">Entradas</th>
              <th scope="col" class="text-center">Pagado,€</th>
              <th scope="col" class="text-center"></th>
              
            </tr>
          </thead>
          <tbody>
            <!-- bucle para recorrer filas de tabla -->
            @foreach($user->pedidosUser($user->id) as $pedido)
            <tr>
                <th scope="row " class="text-center">{{ $pedido->id }}</th>
                <td class="">{{ $pedido->consultarCine($pedido->peliculas_id) }}</td>
                <td class="text-center">{{ $pedido->consultarHora($pedido->peliculas_id) }}</td>
                <td class="text-center">{{ $pedido->entradas }}</td>
                <td class="text-center">{{ $pedido->coste }}</td>
                <td><button class='btn btn-warning mx-0'>Reinviar ticket</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
        @else
            <p class="text-center display-4 my-5">Todavia no tienes pedidos</p>   
        @endif
      <div class="row justify-content-center">
      <a href="/" class='btn btn-warning btn-mio'>Volver a la pagina principal</a></div>
    </div>         
    @endif
      </div>
  </div>
</div>
@endsection

 <!-- footer -->
 @section("pie")

@endsection
