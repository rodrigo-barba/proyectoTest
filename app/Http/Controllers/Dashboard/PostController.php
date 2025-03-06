<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\PutRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        // session(['key' =>'value']);
        // session(['key2' =>'value2']);
        // session()->forget('key2');
        // session()->flush();

        $posts = Post::paginate(5); // cant registros por pagina
        return view('dashboard.post.index', compact('posts'));

        // $post = Post::find(2);
        // dd($post->category->title);

        // $c = Category::find(1);
        // dd($c->posts[1]->title);

        // return response()->json([
        //     'name' => 'Abigail',
        //     'state' => 'CA',
        // ]);

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

        //return 'metodo index';
    }


    /** Show the form for creating a new resource. */
    public function create()
    {   //como tengo que llenar un combo, necesito el lookup de categorias
        $categories = Category::pluck('id', 'title');
        //instancio un objeto post vacio, solo para usarlo en el fragmento de la vista '_form'
        $post = new Post();

        //paso categorias como parametro
        return view('dashboard.post.create', compact('categories', 'post'));
    }


    /** Store a newly created resource in storage. */
    public function store(StoreRequest $request)
    {
        // valida e inserta en la DB 
        Post::create($request->validated());
        //redirecciono a index
        return to_route('post.index')->with('status', 'Post creado exitosamente.');

        //valida los datos del formulario
        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'required|min:10',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:10',
        //     'posted' => 'required'
        // ]);

        // inserta en la DB 
        //Post::create($request->all());
        //redirecciono a index
        //return to_route('post.index');

        // dd(request()->all()); 
        // dd(request()->get('title'));
        // aca detallo cada campo, en vez de usar directamente $request->all()
        // Post::create(
        //     [
        //         'title' => $request->all()['title'],
        //         'slug' => $request->all()['slug'],
        //         'content' => $request->all()['content'],
        //         'category_id' => $request->all()['category_id'],
        //         'description' => $request->all()['description'],
        //         'posted' => $request->all()['posted'],
        //         //'image' => $request->all()['image']  todavia no tengo ese valor
        //     ]
        // );
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', ['post' => $post]);
    }


    /** Show the form for editing the specified resource. */
    public function edit(Post $post)
    {
        //obtengo id y titulo de la categoria para trabajar
        $categories = Category::pluck('id','title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }


    /** Update the specified resource in storage.  */
    public function update(PutRequest $request, Post $post)
    {
        //valida los campos (incluida la imagen)
        $data = $request->validated();

        //si se provee una imagen
        if(isset($data['image'])) {
            //para que el nombre del archivo sea único, uso time (hora en milisegundos)
            $filename = time().'.'.$data['image']->extension();
            $data['image'] = $filename;
            //muevo la imagen a la carpeta destino
            $request->image->move(public_path('uploads/posts'), $filename);
        }

        $post->update($data);
        return to_route('post.index')->with('status', 'Post actualizado exitosamente.');
    }


    /** Remove the specified resource from storage.  */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('status', 'Post eliminado exitosamente.');
    }
}
