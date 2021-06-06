<body style="background-image: url(../images/CREAR.jpg);">

@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url ('/personaje') }}" method="post" enctype="multipart/form-data" > 
@csrf

@include('personaje.form',['modo'=>'Crear'])


</form>
</div>
@endsection

</body>