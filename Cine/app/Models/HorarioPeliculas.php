<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horario;

class HorarioPeliculas extends Model
{
    use HasFactory;
    protected $fillable = [
        'horario_id',
        'peliculas_id',
        'plazos_libres',
        'precio'
    ];

    // devuelva string - dia y hora
    public function consultHorario($id){
        $horario = Horario::find($id);
        $cadena = $horario->dia.' '.$horario->hora;
        return $cadena;
      }

       // metodo para obtener plazos libres para hora concreta de una pelicula
    public function consultarPlazosLibres($id_hora){
        $cine = HorarioPeliculas::find($id_hora)->pluck('plazos_libres');
         return $cine->first();
    }
}
