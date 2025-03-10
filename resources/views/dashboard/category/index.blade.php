@extends('dashboard.layout')

@section('content')
    <h1>Categorías</h1>

    <a class="btn btn-primary my-3" href="{{ route('category.create')}}">Crear nueva categoria</a>

    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->title}}</td>
                <td>
                    <a class="btn btn-primary mt-2" href="{{ route('category.edit', $c) }}">Editar</a>
                    <a class="btn btn-primary mt-2" href="{{ route('category.show', $c) }}">Ver</a>
                    <form action="{{ route('category.destroy', $c) }}" method="post">
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
        {{ $categories->links() }}
    </div>

@endsection











