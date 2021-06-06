@extends('layouts.app')

@section('content')

<body style="background-image: url(../images/PERSONAJES.jpg);">
<div class="container">

    <div>
        <h1 class="display-1 text-white">PERSONAJES</h1>
    </div>


    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>

    @endif



    <a href="{{ url('personaje/create') }}" class="btn btn-warning"> Registrar nuevo personaje</a>
    <br>
    <br>

    <table class="table table-light">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Habilidad</th>
                <th>Anime</th>
                <th>Acciones</th>
            </tr>
        </thead>

        @foreach ($personajes as $personaje)

        <tbody>
            <tr>
                <td>{{ $personaje->id }}</td>

                <td>
                    <img class="img-thumbnail img-" style="width: 50px; height: 50px;" src="{{ asset('storage').'/'.$personaje->Foto }}" att="">
                </td>

                <td>{{ $personaje->Nombre }}</td>
                <td>{{ $personaje->Habilidad }}</td>

                @foreach ($animes as $anime)
                @if($anime->id===$personaje->anime_id)
                <td>{{ $anime->Nombre }}</td>
                @endif
                @endforeach
                <td>

                    <a href="{{ url('/personaje/'.$personaje->id.'/edit')}}" class="btn btn-dark">
                        Editar
                    </a>


                    <form action="{{url('/personaje/'.$personaje->id) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}

                        <input class="btn btn-warning" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">

                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

</body>