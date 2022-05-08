<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    public function peliculas(){
        return $this->belongsToMany(Peliculas::class);
      
    }

    public function isEmpty(){
      $horas = Horario::all();

      if(isEmpty($horas))
      {
         return true;
       }else{
          return false;
       }
    }
// devuelva string - dia y hora
    public function consultHorario($id){
      $horario = Horario::find($id);
      $cadena = $horario->dia.' '.$horario->hora;
      return $cadena;
    }
}
