<body style="background-image: url(../images/EDITAR.png);">

    <h1>{{$modo}} Personajes</h1>

    @if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>

            @foreach( $errors->all() as $error)
            <li> {{ $error }} </li>
            @endforeach

        </ul>
    </div>

    @foreach( $errors->all() as $error)
    {{ $error}}
    @endforeach

    @endif

    <div class="form-group">
        <label for="Nombre"> Nombre </label>
        <input type="text" name="Nombre" class="form-control" value="{{ isset($personaje->Nombre)?$personaje->Nombre:old('Nombre') }}" id="Nombre">
    </div>
    <?php /*
        <div class="form-group">
        <label for="Nombre"> Anime </label>
        <input type="text" class="form-control" value="{{ isset($personaje->Anime)?$personaje->Anime:old('Anime') }}" name="Anime" id="Anime">
        </div>*/ ?>


    <div class="form-group">
        <label for="Nombre" class="form-label">Anime</label>
        <select class="form-select" name="anime_id" id="anime_id" aria-label="Default select example">
            @foreach ($animes as $anime)
            <option value="{{$anime->id}}" id="anime_id">{{$anime->Nombre}}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="Nombre"> Habilidad </label>
            <input type="text" class="form-control" value="{{ isset($personaje->Habilidad)?$personaje->Habilidad:old('Habilidad') }}" name="Habilidad" id="Habilidad">
        </div>

        <div class="form-group">
            <label for="Nombre"></label>
            @if(isset($personaje->Foto))
            <img style="width: 100px; height: 100px;" class="img-thumbnail img-" src="{{ asset('storage').'/'.$personaje->Foto }}" att="">
            @endif
            <input type="file" value="" name="Foto" id="Foto">
        </div>

        <input class="btn btn-success" type="submit" value="{{ $modo }} datos">

        <a class="btn btn-primary" href="{{ url('personaje') }}"> Regresar</a>

        <br>

</body>