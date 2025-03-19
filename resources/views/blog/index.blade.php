@extends('blog.layout')

@section('content')
    <x-blog.post.index :posts='$posts'></x-blog.post.index>
@endsection


