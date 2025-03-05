@extends('dashboard.layout')

@section('content')

    <h1>{{ $post->title }}</h1>

    <div>{{ $post->posted }}</div>
    <div>{{ $post->category->title }}</div>
    <div>{{ $post->description }}</div>
    <div>{{ $post->content }}</div>

    <div>Archivo imagen: {{ $post->image }}</div>
    <img src="/uploads/posts/{{ $post->image }}" style="width:250px" alt="{{ $post->title }}">
    
@endsection











