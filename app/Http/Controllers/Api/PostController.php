<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;

class PostController extends Controller
{
    /** Devuelve todos los registros, sin paginar. */
    public function all()
    {
        return response()->json(Post::get());
    }

    /** Display the specified resource.    */
    public function slug(string $slug)
    {
        //busca ael 1er registro que coincida, en caso de no encontrar ninguno, falla
        $post = Post::where('slug', $slug)->firstOrFail();
        return response()->json($post);
    }

    /** Display a listing of the resource.    */
    public function index()
    {
        return response()->json(Post::paginate(5)); // cant registros por pagina
    }

    /** Store a newly created resource in storage.    */
    public function store(StoreRequest $request)
    {
        // valida e inserta en la DB 
        return response()->json(Post::create($request->validated()));
    }

    /** Display the specified resource.   */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /** Update the specified resource in storage.    */
    public function update(PutRequest $request, Post $post)
    {
        // valida y actualiza en la DB 
        $post->update($request->validated());
        //en API, no me permite usar el metodo estático
        //$post = Post::update($request->validated());
        return response()->json($post);
    }

    /** Remove the specified resource from storage.    */
    public function destroy(Post $post)
    {
        $post->delete();
        // sería mejor retornar un status que un string o booleano
        return response()->json('OK');
    }
}
