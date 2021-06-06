<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;

    protected $fillable=[
        'Nombre','Habilidad','Foto',
    ];


    public function Personaje()
    {
        return $this->belongsTo(Anime::class);
    }
}
