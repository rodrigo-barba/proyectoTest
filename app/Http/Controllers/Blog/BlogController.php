<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    function index() {
        $posts = Post::paginate(5);
        return view('blog.index', compact('posts'));
    }

    // metodo SHOW sin usar cache
    // function show(Post $post) {
    //     return view('blog.show', compact('post'));
    // }

    // metodo SHOW usando cache
    function show(int $id) {
        // el refijo es para asegurarme que el id no se repite
        $key = 'post_show_'.$id;

        // El rememberForever hace la operatoria de almacenar en cache el elemento, si no existe
        // el use() es de PHP y sirve para mapear un parámetro, o lo que sea, dentro del callback
        return Cache::rememberForever($key, function() use ($id) {
            // obtengo el posteo con su categoria
            $post = Post::with('category')->find($id);
            return view('blog.show', ['post' => $post])->render();
        });

        // pregunto si existe el elemento en Cache
        // if (Cache::has($key)) {
        //     // echo ('cache');
        //     // regresa la vista desde la cache
        //     return Cache::get($key);
        // } else {
        //     // echo ('no cache');
        //     //renderiza la vista
        //     $cacheView = view('blog.show', ['post' => $post])->render();
        //     // agrega a cache la vista sin limite de tiempo
        //     Cache::put($key, $cacheView);
        //     return $cacheView;
        // }   
    }

}
