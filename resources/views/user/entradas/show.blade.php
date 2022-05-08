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
        @endif

        
    </div>  
              
          
   
        
       
@endsection
<!-- Footer -->
@section("pie")

@endsection