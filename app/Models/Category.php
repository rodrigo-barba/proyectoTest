<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //en caso que no especificara los timestamps, en la migracion, pongo:
    //public $timestamps = false;

    //fillable es un atributo de los modelos Eloquent que define qué campos PUEDEN SER ASIGNADOS MASIVAMENTE.
    //Si intentas insertar un campo que no está en fillable, Laravel lo ignorará o lanzará un error.
    //gracias a esto, puedo usar: Post::create(...)
    //1. Protege contra asignación masiva (Mass Assignment).
    //2. Evita que usuarios malintencionados inserten datos no permitidos.
    protected $fillable = ['title', 'slug'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
