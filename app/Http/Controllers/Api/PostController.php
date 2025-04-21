<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /** Devuelve todos los registros, sin paginar. */
    public function all()
    {
        // si exite, devuelvo lo que hay en cache
        // si no existe, cargo en cache y devuelvo lo traido de la DB
        // le doy una validez de 10 minutos
        return response()->json(Cache::remember('posts_index', now()->addMinutes(10), function() {
            return Post::all();
        }));


        // si no exite el elemento en cache
        // if (!cache()->has('posts_index')) {
        //     $posts = Post::get();
        //     cache()->put('posts_index', $posts);
        //     return response()->json($posts);
        // }
        // return response()->json(cache()->get('posts_index'));


        //sin cache
        // return response()->json(Post::get());
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
        //el with me devuelve los datos de la entidad relacionada (categoria) 
        return response()->json(Post::with('category')->paginate(5)); // cant registros por pagina
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

    public function upload(Request $request, Post $post) {
        //valido tipo de archivo
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
        ]);

        Storage::disk('public_upload')->delete("image/".$post->image);

        //genero nombre del archivo
        $filename = time() . '.' . $request->image->extension();
        //asigno al campo image el nombre del arxhivo
        $data['image'] = $filename;
        //muevo el archivo a una carpeta 'image' dentro de 'public'
        //'public' es la unica arpeta que puede acceder el usr
        $request->image->move(public_path('image'), $filename);

        //ojo! para hacer esto, image debe estar omo fillable en el modelo
        $post->update($data);
        return response()->json($post);
    }
}
