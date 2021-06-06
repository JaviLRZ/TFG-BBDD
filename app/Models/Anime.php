<?php

namespace App\Models;

use App\Http\Controllers\PersonajeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable=[
        'Nombre','Genero','Año','Puntuacion','Foto', 'Estado'
    ];



    public function Anime()
    {
        return $this->hasMany(Personaje::class);
    }
}

