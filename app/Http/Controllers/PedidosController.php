<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peliculas;
use App\Models\HorarioPeliculas;
use App\Models\Horario;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
       
        return view('user.entradas.index', compact('user')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $entrada = $request->validate([
            'user_id'=>'numeric|min:1',
            'cine_id'=> 'numeric|min:1',
            'fecha_id'=> 'min:1',
            'entradas'=>'required|numeric|max:10|min:1',
            
        ]);
        $cine=Peliculas::find($request->cine_id);
        $precio=HorarioPeliculas::find($request->fecha_id)->precio; //precio de una entrada
        $total=$request->entradas*intval($precio); //precio total de pedido
        
        $plazos_exist = HorarioPeliculas::find($request->fecha_id)->plazos_libres; //cantidad de plazos libres
        
        if($request->entradas > $plazos_exist){
            return "plazos comprar: ".$request->entradas." plazos exist: ".$plazos_exist;
     
           // return "disculpa, ya no hay plazos sufucientes para esta pelicula";
        }elseif($user->id){
            $pedido=['users_id'=>$request->user_id, 'peliculas_id'=>$request->cine_id, 'entradas'=>$request->entradas, 'coste'=>$total, 'fecha_cine'=>$request->fecha_id];
            Pedido::create($pedido);
            $id_entradas = $cine->consultarIdHoraPelicula($request->cine_id, $request->fecha_id);
            
            $hora_cine = HorarioPeliculas::find($request->fecha_id);
            $hora_cine->plazos_libres= $plazos_exist - ($request->entradas);
            $hora_cine->save();
            $cines=Peliculas::all();
            return view('home', compact('user','cines'));
              
            }else{
                return "No estas logeado";
            }
             
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id2)
    {
        $user = Auth::user();
        $cine = Peliculas::findOrFail($id2);
       // $horario = HorarioPeliculas::all()->where('peliculas_id',$id2)->pluck('horario_id')->first();
        $horario = HorarioPeliculas::all()->where('peliculas_id',$cine->id);
      //  $horario = Horario::all()->where('id',$horarioCine->horario_id);
         return view('user.entradas.create', compact('cine','horario','user'));
         //return "estoy aqui";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
