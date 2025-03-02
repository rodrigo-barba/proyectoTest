<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $post = Post::find(2);
//        dd($post->category->title);

        $c = Category::find(1);
        dd($c->posts[1]->title);

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);

        //find = select * from posts where id=1
        //$post = Post::find(2);

        // find + delete en una sola linea
        //$post = Post::find(1)->delete();

        // dd($post);  //dump & die: para depurar. (Response.Write <algo>:Response.End)

        // inserta en la DB y devuelve el objeto creado
        // $post = $post->update(
        //     [
        //         'title' => 'titulo actualizado',
        //         'content' => 'content actualizado'
        //     ]
        // );

        // inserta en la DB y devuelve el objeto creado
        //  $post = Post::create(
        //     [
        //         'title' => 'prueba titulo',
        //         'slug' => 'prueba slug',
        //         'content' => 'prueba content',
        //         'category_id' => 1,
        //         'description' => 'prueba description',
        //         'posted' => 'not',
        //         'image' => 'prueba image'
        //     ]
        // );
    
    
        return 'metodo index';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
