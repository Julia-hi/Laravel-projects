<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peliculas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $cines = Peliculas::all();
        $user = Auth::user();
      
       $request->session()->put([$user->id=>$user->rol]);
       $request->session()->flash($user,$user->rol); //guardar ultimas dos sessiones
       // $request->session()->regenerate(); //para cambiar token
        $request->session()->all();
         return view('home', compact('cines', 'user', 'request'));
    }
}
