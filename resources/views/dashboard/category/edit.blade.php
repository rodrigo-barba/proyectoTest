@extends('dashboard.layout')

@section('content')
    <h1>Actualizar Categoría: {{ $category->title }}</h1>

    @include('dashboard.fragments._errors-form')

    <form action="{{ route('category.update', $category->id)}}" method="POST">
        @method("PATCH")
        {{-- el parametro task es para que el fragmento _form sepa que vengo de un edit y no un create
             para poder cargar una imagen --}}
        @include('dashboard.category._form', ['task' => 'edit'])

    </form>    
@endsection


