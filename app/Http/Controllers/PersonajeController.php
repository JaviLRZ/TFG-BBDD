<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Personaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$personajes['personajes']=Personaje::paginate(5);

        $personajes['personajes']=Anime::join("personajes","animes.id","=","personajes.anime_id")->get();
        $animes['animes']=Anime::all();
        return view ('personaje.index',$personajes, $animes);
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Models\Anime $animes
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animes=Anime::all();
        return view('personaje.create',compact('animes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Habilidad'=>'required|string|max:100',
            'Foto'=>'required|max:1000|mimes:jpeg,png,jpg' ,
            'anime_id'   

        ];


        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La Foto es requerida'         
        ];

        $this->validate($request, $campos, $mensaje);

        //$datosPersonaje = request()->all();

        $datosPersonaje = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosPersonaje['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Personaje::insert($datosPersonaje);


        
       // return response()->json($datosPersonaje);

       return redirect('personaje')->with('mensaje','Personaje agregado con éxito');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personaje  $personaje
     * @param   \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(Personaje $personaje)
    {
        //
        return view ('personajes.show', compact('personaje','animes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personaje  $personaje
     * @param   \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(Personaje $personaje)
    {
        //
        $animes= Anime::all();

        return view('personaje.edit', compact('personaje','animes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Habilidad'=>'required|string|max:100',
            'anime_id'
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',           
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:1000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida']; 
        }

        $this->validate($request, $campos, $mensaje);


        $datosPersonaje= request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $personaje=Personaje::findOrFail($id);

            Storage::delete('public/'.$personaje->Foto);

            $datosPersonaje['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Personaje::where('id','=',$id)->update($datosPersonaje);
        $personaje=Personaje::findOrFail($id);
        //return view('personaje.edit', compact('personaje') );

        return redirect('personaje')->with('mensaje','personaje Modificado', );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $personaje=Personaje::findOrFail($id);

        if(Storage::delete('public/'.$personaje->Foto)){
           
            Personaje::destroy($id);
        }





        return redirect('personaje')->with('mensaje','Personaje Borrado');
    }
}


