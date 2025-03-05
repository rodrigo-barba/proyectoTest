@extends('dashboard.layout')

@section('content')

    <a href="{{ route('post.create')}}">Crear nuevo post</a>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Posted</th>
            <th>Category</th>
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
                    <a href="{{ route('post.edit', $p) }}">Editar</a>
                    <a href="{{ route('post.show', $p) }}">Ver</a>
                    <form action="{{ route('post.destroy', $p) }}" method="post">
                        @method('DELETE');
                        @csrf
                        <button type="submit">Borrar</button>
                    </form>
                </td>
            </tr>

            @endforeach
    </tbody>
    </table>

    {{ $posts->links() }}

@endsection











