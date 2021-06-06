<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Personaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $animes['animes']=Anime::paginate(5);
        return view ('anime.index',$animes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anime.create');
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
            'Genero'=>'required|string|max:100',
            'Año'=>'required',
            'Estado'=>'required|string|max:100',
            'Puntuacion'=>'required|numeric|between:0,99.99',
            'Foto'=>'required|max:1000|mimes:jpeg,png,jpg'
        ];


      /*  $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La Foto es requerida'         
        ];

        $this->validate($request, $campos, $mensaje);*/

        //$datosAnime = request()->all();

        $datosAnime = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosAnime['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Anime::insert($datosAnime);
        
       // return response()->json($datosAnime);

       return redirect('anime')->with('mensaje','Anime agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(Anime $anime)
    {
        //
        return view ('anime.show',compact('anime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(Anime $anime)
    {
        //
        return view('anime.edit', compact('anime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Genero'=>'required|string|max:100',
            'Año'=>'required',
            'Estado'=>'required|string|max:100',
            'Puntuacion'=>'required|numeric|between:0,99.99'         
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',           
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:1000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida']; 
        }

        $this->validate($request, $campos, $mensaje);


        $datosAnime = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $anime=Anime::findOrFail($id);

            Storage::delete('public/'.$anime->Foto);

            $datosAnime['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Anime::where('id','=',$id)->update($datosAnime);
        $anime=Anime::findOrFail($id);
        //return view('anime.edit', compact('anime') );

        return redirect('anime')->with('mensaje','Anime Modificado');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $anime=Anime::findOrFail($id);

        if(Storage::delete('public/'.$anime->Foto)){
           
            Anime::destroy($id);
        }





        return redirect('anime')->with('mensaje','anime Borrado');
    }
}