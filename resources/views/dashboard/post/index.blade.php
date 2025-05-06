@extends('dashboard.layout')

@section('content')
    <h1>Posteos</h1>

    <a class="btn btn-primary my-3" href="{{ route('post.create')}}">Crear nuevo post</a>

    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Posteado</th>
            <th>Categoría</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $p)
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->title}}</td>
                <td>{{$p->posted}}</td>
                <td>{{$p->category->title}}</td>
                <td>
                    {{-- este div lo agreegué yo para que esté todo en una linea, pero en pantallas pequeñas se apilen automáticamente --}}
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; align-items: center;">
                        <a class="btn btn-primary mt-2" href="{{ route('post.edit', $p) }}">Editar</a>
                        <a class="btn btn-primary mt-2" href="{{ route('post.show', $p) }}">Ver</a>
                        <form action="{{ route('post.destroy', $p) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger mt-2" type="submit">Borrar</button>
                        </form>
                    
                </td>
            </tr>

            @endforeach
    </tbody>
    </table>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>

@endsection











