<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /** Devuelve todos los registros, sin paginar. */
    public function all()
    {
        return response()->json(Category::get());
    }

    /** Display the specified resource.    */
    public function slug(string $slug)
    {
        //busca ael 1er registro que coincida, en caso de no encontrar ninguno, falla
        $category = Category::where('slug', $slug)->firstOrFail();
        return response()->json($category);
    }

    /** Display a listing of the resource.    */
    public function index()
    {
        return response()->json(Category::paginate(10));
    }

    /** Store a newly created resource in storage.  */
    public function store(StoreRequest $request)
    {
        // valida e inserta en la DB 
        return response()->json(Category::create($request->validated()));
    }

    /** Display the specified resource.    */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /** Update the specified resource in storage.   */
    public function update(PutRequest $request, Category $category)
    {
        // valida y actualiza en la DB 
        $category->update($request->validated());
        //en API, no me permite usar el metodo estático
        //$category = Category::update($request->validated());
        return response()->json($category);
    }

    /** Remove the specified resource from storage.   */
    public function destroy(Category $category)
    {
        $category->delete();
        // sería mejor retornar un status que un string o booleano
        return response()->json('OK');
    }
}
