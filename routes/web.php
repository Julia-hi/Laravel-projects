<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peliculas;
use App\Models\HorarioPeliculas;
use App\Models\Horario;
use App\Models\Pedido;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    $cines = Peliculas::all();
    if($user){
        $value = session($user->id); //recupera los datos de sesion
        session(['key' => 'value']); //guarda los datos de sesion
    }
    session(['key' => 'value']); //guarda los datos de sesion
    return view('welcome',compact('user', 'cines'));
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/admin/cines', App\Http\Controllers\AdminCinesController::class);

Route::resource('/admin/pedidos', App\Http\Controllers\AdminPedidosController::class);

Route::resource('/peliculas', App\Http\Controllers\CinesController::class)->only(['index', 'show']);

Route::resource('user.entradas', App\Http\Controllers\PedidosController::class);
