<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //para poder usar el factory
    use HasFactory;

    //fillable es un atributo de los modelos Eloquent que define qué campos PUEDEN SER ASIGNADOS MASIVAMENTE.
    //Si intentas insertar un campo que no está en fillable, Laravel lo ignorará o lanzará un error.
    //gracias a esto, puedo usar: Post::create(...)
    //1. Protege contra asignación masiva (Mass Assignment).
    //2. Evita que usuarios malintencionados inserten datos no permitidos.
    protected $fillable = ['title', 'slug', 'content', 'category_id', 'description', 'posted', 'image', 'user_id'];

    /* insert into `posts` 
        (`title`, `slug`, `content`, `category_id`, `description`, `posted`, `image`, `updated_at`, `created_at`) 
        values 
        (prueba titulo, prueba slug, prueba content, 1, prueba description, not, prueba image, 
        2025-03-02 18:10:11, 2025-03-02 18:10:11)
    */

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
