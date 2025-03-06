<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\PutRequest;


class CategoryController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $categories = Category::paginate(5); // cant registros por pagina
        return view('dashboard.category.index', compact('categories'));
    }


    /** Show the form for creating a new resource. */
    public function create()
    {
        //instancio un objeto category vacio, solo para usarlo en el fragmento de la vista '_form'
        $category = new Category();

        //paso categorias como parametro
        return view('dashboard.category.create', ['category' => $category]);
    }


    /** Store a newly created resource in storage. */
    public function store(StoreRequest $request)
    {
        // valida e inserta en la DB 
        Category::create($request->validated());
        //redirecciono a index
        return to_route('category.index')->with('status', 'Categoria creada exitosamente.');
    }


    /** Display the specified resource. */
    public function show(Category $category)
    {
        return view('dashboard.category.show', ['category' => $category]);
    }


    /** Show the form for editing the specified resource. */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', ['category' => $category]);
    }


    /** Update the specified resource in storage. */
    public function update(PutRequest $request, Category $category)
    {
        //valida los campos y graba a la DB
        $category->update($request->validated());
        return to_route('category.index')->with('status', 'Categoria actualizada exitosamente.');
    }


    /** Remove the specified resource from storage. */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('category.index')->with('status', 'Categoria eliminada exitosamente.');
    }
}
