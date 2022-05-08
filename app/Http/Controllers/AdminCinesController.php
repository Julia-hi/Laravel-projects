<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peliculas;
use App\Models\HorarioPeliculas;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AdminCinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cines = Peliculas::all();
        $user = Auth::user();
        return view('admin.cines.index', compact('cines', 'user'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horario = Horario::all();
        $user = Auth::user();
        return view('admin.cines.create', compact('horario','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entrada = $request->validate([
            'nombre_pelicula'=>'required|max:200',
            'genero'=>'required|max:40',
            'anio'=>'required',
            'paisOrigen'=>'required|max:50',
            'description'=>'required',
            'dia'=>'required', 
            'precio'=> 'required | max:2',
           // 'plazos_libres'=>'nullable|numeric', 
        ]);

        if($archivo =$request->file('foto')){
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images/cine-images',$nombre); //guarda imagen en fichero /public/imagenes/cine-images
            $entrada['foto']=$nombre;
        }
        
        $horas = $request->dia; // array de horarios elegidos
        
        if(intval($request->precio)){
            $cine =Peliculas::create($entrada);
            $cine->horario()->attach($horas,['precio'=>$request->precio, 'plazos_libres'=>$request->plazos_libres]);

        }
        $cines = Peliculas::all();
        $user = Auth::user();
      return view('admin.cines.index', compact('cines', 'user'));
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $cine = Peliculas::findOrFail($id);
        $horario = Horario::all();
        $user = Auth::user();
        return view("admin.cines.edit", compact('cine','horario', 'user'));
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
        $cine = Peliculas::find($id);
        $user = Auth::user();

        $entrada = $request->validate([
            'nombre_pelicula'=>'required|max:200',
            'genero'=>'required|max:40',
            'anio'=>'required|numeric',
            'paisOrigen'=>'required|max:50',
            'description'=>'required',
            'dia'=>'required', 
            'precio'=> 'required | max:2', //string
            'foto'=>'required',
        ]);

        if($request->hasFile('foto')){
            $destination='images'.$cine->foto;
            if(File::exists($destination)){
                File::delete($destination);
            }

        if($archivo =$request->file('foto')){
            
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images',$nombre); //guarda imagen en fichero /public/imagenes
            $entrada['foto']=$nombre;
        }}
        
        $horas = $request->dia; // array de horarios elegidos
        
        if(intval($request->precio)){
         
            $cine->nombre_pelicula = $request->nombre_pelicula;
            $cine->genero = $request->genero;
            $cine->anio = $request->anio;
            $cine->paisOrigen = $request->paisOrigen;
            $cine->description = $request->description;
    
            $cine->save();  
            $cine->horario()->syncWithPivotValues($horas,['precio'=>$request->precio, 'plazos_libres'=>$request->plazos_libres]);
        }  
       return redirect('/admin/cines')->with('success', '¡Pelicula guardada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
        {
            $cine = Peliculas::findOrFail($id);
            $cine->delete();
            return redirect ('/admin/cines');
        }
}
