<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'peliculas_id',
        'users_id',
        'entradas',
        'coste',
        'fecha_cine'
    ];

    public function consultarCine($id){
        $cine = Peliculas::all()->where('id', $id)->pluck('nombre_pelicula');
         return $cine->first();
    }

    public function consultarHora($id){
        $cineDia = Horario::all()->where('id', $id)->pluck('dia');
        $cineHora = Horario::all()->where('id', $id)->pluck('hora');
         return $cineDia->first()." | ".$cineHora->first();
    }

    public function isEmpty(){
        $pedido = Pedido::all();
        if(isEmpty($pedido))
        {
           return true;
         }else{
            return false;
         }
      }

    // total dinero de todos pedidos
    public function sumaCostes(){
        $pedido = Pedido::all();
        $total = $pedido->sum('coste');
        return $total;
      }

    // total entradas vendidas de todos pedidos 
    public function sumaEntradas(){
        $pedido = Pedido::all();
        $total = $pedido->sum('entradas');
        return $total;
      }

    //funcción devuelva info de pelicula que tiene más ventas (una pelicula, aun si varios tienen misma cantidad de entradas vendidas)
    public function masPopular(){
        $pedidos = Pedido::all(); //todos pedidos
        $cines = DB::table('pedidos')->select('peliculas_id')->distinct()->get(); //lista de id de peliculas que tiene algun pedido
        $entradas = array(); //array de entradas de peliculas (sin repetir)
        //bucle para recorrer array de peliculas
        for($i=0; $i<count($cines); $i++){
            $entradas[$i]=$pedidos->where('peliculas_id', $cines[$i]->peliculas_id)->sum('entradas'); //suma de entradas compradas para cada pelicula
        }
        //bucle para recorrer array de peliculas
        for($i=0; $i<count($cines); $i++){
            if($pedidos->where('peliculas_id', $cines[$i]->peliculas_id)->sum('entradas')==max($entradas)){
                $cine=Peliculas::find($cines[$i]->peliculas_id); //primera pelicula que tiene maximas ventas
            }
        }
        return '"'.$cine->nombre_pelicula.'" (id: '.$cine->id." ,vendido: ".max($entradas)." entradas)";
    }

    //funcción devuelva info de pelicula que tiene menos ventas (una pelicula, aun si varios tienen misma cantidad de entradas vendidas)
    public function menosPopular(){
        $pedidos = Pedido::all(); //todos pedidos
        $cines = DB::table('pedidos')->select('peliculas_id')->distinct()->get(); //lista de id de peliculas que tiene algun pedido
        $entradas = array(); //array de entradas de peliculas (sin repetir)
        //bucle para recorrer array de peliculas
        for($i=0; $i<count($cines); $i++){
            $entradas[$i]=$pedidos->where('peliculas_id', $cines[$i]->peliculas_id)->sum('entradas'); //suma de entradas compradas para cada pelicula
        }
        //bucle para recorrer array de peliculas
        for($i=0; $i<count($cines); $i++){
            if($pedidos->where('peliculas_id', $cines[$i]->peliculas_id)->sum('entradas')==min($entradas)){
                $cine=Peliculas::find($cines[$i]->peliculas_id); //primera pelicula que tiene maximas ventas
            }
        }
        return '"'.$cine->nombre_pelicula.'" (id: '.$cine->id." ,vendido: ".min($entradas)." entradas)";
    }

}