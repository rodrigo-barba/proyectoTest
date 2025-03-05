@extends('dashboard.layout')

@section('content')

    <a href="{{ route('category.create')}}">Crear nueva categoria</a>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->title}}</td>
                <td>
                    <a href="{{ route('category.edit', $c) }}">Editar</a>
                    <a href="{{ route('category.show', $c) }}">Ver</a>
                    <form action="{{ route('category.destroy', $c) }}" method="post">
                        @method('DELETE');
                        @csrf
                        <button type="submit">Borrar</button>
                    </form>
                </td>
            </tr>

            @endforeach
    </tbody>
    </table>

    {{ $categories->links() }}

@endsection











