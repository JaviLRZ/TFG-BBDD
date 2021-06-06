@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url ('/anime/'.$anime->id) }}" method="post" enctype="multipart/form-data">
@csrf 
{{ method_field('PATCH') }} 

@include('anime.form',['modo'=>'Editar'])

</form>
</div>
@endsection