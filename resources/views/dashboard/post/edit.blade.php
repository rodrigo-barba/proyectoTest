@extends('dashboard.layout')

@section('content')
    <h1>Actualizar Post: {{ $post->title }}</h1>

    @include('dashboard.fragments._errors-form')

    <form action="{{ route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @method("PATCH")
        {{-- el parametro task es para que el fragmento _form sepa que vengo de un edit y no un create
             para poder cargar una imagen --}}
        @include('dashboard.post._form', ['task' => 'edit'])

    </form>    
@endsection


