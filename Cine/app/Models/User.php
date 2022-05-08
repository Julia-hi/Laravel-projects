<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Pedido;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pedido(){
        return $this->hasMany('\App\Models\Pedido');
    }
    
    public function esAdmin(){
    
        if($this->rol == "admin"){
            return true;
        }else{
            return false;
        } 
    }

    public function isEmpty(){
        $user = User::all();
  
        if(isEmpty($user))
        {
           return true;
         }else{
            return false;
         }
      }
//devualva numero total de pedidos para un usuario
      public function consultarPedidos($id){
            $pedidos = Pedido::all()->where('users_id', $id)->count();
            return $pedidos;
      }
// decualva array de pedidos de un usuario
      public function pedidosUser($id){
        $pedidos = Pedido::all()->where('users_id', $id);
        return $pedidos;
      }

}
