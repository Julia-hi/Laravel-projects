<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Peliculas extends Model
{
    use HasFactory;
    
    use HasFactory;
    protected $fillable = [
        'nombre_pelicula',
        'genero',
        'anio',
        'paisOrigen',
        'description',
        'foto'
    ];
  
    public function horario(){
     return $this->belongsToMany(Horario::class)->withPivot(['precio', 'plazos_libres'])->withTimestamps();
    }

    public function isEmpty(){
        $pelicula = Peliculas::all();
        if(isEmpty($pelicula))
        {
           return true;
         }else{
            return false;
         }
      }

    public function isChecked($id, $dia){
        $cine = Peliculas::find($id);
        if(HorarioPeliculas::all()->where('horario_id', $dia)->where('peliculas_id', $id)->pluck('id')->first()!=null){
            return true;
        }else{
            return false;
        }
      }

    public function consultarPlazos($id){
        $cine = Peliculas::find($id);
        foreach($cine->horario as $horario){
            return $horario->pivot->plazos_libres;
        }
        
    }
    public function consultarPrecio($id){
        $cine = Peliculas::find($id);
        foreach($cine->horario as $horario){
            return $horario->pivot->precio;
        }   
    }

    
    // metodo para obtener precio para hora concreta de una pelicula
    public function consultarPrecioHora($id,$id_hora){
        $cine = HorarioPeliculas::all()->where('horario_id', $id_hora)->where('peliculas_id', $id)->pluck('precio');
         return $cine->first();
    }
    // metodo para obtener plazos libres para hora concreta de una pelicula
    public function consultarPlazosLibres($id_hora){
        $cine = HorarioPeliculas::find($id_hora)->pluck('plazos_libres');
         return $cine->first();
    }

    public function consultarIdHoraPelicula($id,$id_hora){
        $cine = HorarioPeliculas::all()->where('horario_id', $id_hora)->where('peliculas_id', $id)->pluck('id');
         return $cine->first();
    } 

    
}
