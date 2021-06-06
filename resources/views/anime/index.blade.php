@extends('layouts.app')

@section('content')


<body style="background-image: url(../images/FONDO.jpg);">
<div class="container">
    <div>
    <h1 class="display-1 text-white">ANIMES</h1>
    </div>


    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('mensaje') }}   
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>

    </div>

    @endif



<a href="{{ url('anime/create') }}" class="btn btn-warning"> Registrar nuevo anime</a>
<br>
<br>


<table class="table table-light " >
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Genero</th>
            <th>Año</th>
            <th>Estado</th>
            <th>Puntuacion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $animes as $anime )
        <tr>       
            <td>{{ $anime->id }}</td>

            <td>
            <img  class="img-thumbnail img-"  style="width: 50px; height: 50px;" src="{{ asset('storage').'/'.$anime->Foto }}" att="">
            </td>
            
            <td>{{ $anime->Nombre }}</td>
            <td>{{ $anime->Genero }}</td>
            <td>{{ $anime->Año }}</td>
            <td>{{ $anime->Estado }}</td>
            <td>{{ $anime->Puntuacion }}</td>
            <td>

            <a href="{{ url('/anime/'.$anime->id.'/edit')}}" class="btn btn-dark">
            Editar
            </a>


            <form action="{{url('/anime/'.$anime->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <input class="btn btn-warning" type="submit"  onclick="return confirm('¿Quieres borrar?')"
            value="Borrar">

            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table> 
{!! $animes->links()!!}
</div>
@endsection

</body>