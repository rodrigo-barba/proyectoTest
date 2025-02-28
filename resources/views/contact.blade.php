@extends('layout')

@section('content')
    <body>
        <h1>Contact</h1>
        <h2>Hola {{$nombre}}</h2>
        @if ($edad>=18)
            <h3>Sos mayor de edad</h3>
        @else
            <h3>Sos menor de edad</h3>
        @endif
    </body>
@endsection