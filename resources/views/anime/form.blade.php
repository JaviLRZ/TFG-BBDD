<body style="background-image: url(../images/EDITAR.png);">

<h1>{{$modo}} Animes</h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>

            @foreach( $errors->all() as $error)
             <li>  {{ $error }}  </li>
            @endforeach

        </ul>
    </div>

    @foreach( $errors->all() as $error)
        {{ $error}}
    @endforeach

@endif
<div class="form-group " >

    <label for="Nombre"> Nombre </label>
    <input type="text" name="Nombre" class="form-control  "  value="{{ isset($anime->Nombre)?$anime->Nombre:old('Nombre') }}" id="Nombre">

    <label for="Nombre"> Genero </label>
    
    <select class="form-control"  value="{{ isset($anime->Genero)?$anime->Genero:old('Genero') }}" name="Genero" id="Genero">
                <option value="">Choose...</option>
                <option>Shonen</option>
                <option>Shoujo</option>
                <option>Seinen</option>
                <option>Echhi</option>
                <option>Slice of Life</option>
                <option>Isekai</option>
                <option>Escolares</option>
              </select>

    <label for="Nombre"> Año </label>
    <input type="date" class="form-control" value="{{ isset($anime->Año)?$anime->Año:old('Año') }}" name="Año" id="Año">
    

    <label for="Nombre"> Estado </label>
    <select class="form-control" class="form-control" value="{{ isset($anime->Estado)?$anime->Estado:old('Estado') }}" name="Estado" id="Estado">
    <option value="">Choose...</option>
                <option>En Emision</option>
                <option>Cancelado</option>
                <option>Finalizado</option>             
              </select>



    <label for="Nombre"> Puntuación </label>
    <input type="text"  class="form-control" value="{{ isset($anime->Puntuacion)?$anime->Puntuacion:old('Puntuacion') }}" name="Puntuacion" id="Puntuacion">

    <br>



    <label for="Nombre"></label>
    @if(isset($anime->Foto))
    <img style="width: 100px; height: 100px;" class="img-thumbnail img-" src="{{ asset('storage').'/'.$anime->Foto }}" att="">
    @endif
    <input type="file"  value="" name="Foto" id="Foto">
</div>


<input class="btn btn-success" type="submit" value="{{ $modo }} datos"> 

<a class="btn btn-primary" href="{{ url('anime') }}"> Regresar</a>

<br>    

</body>