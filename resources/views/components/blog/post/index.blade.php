<div>
    <h1>Lista de Posteos</h1> 
    <br>
    @foreach ($posts as $p)
        <div class="card card-white mt-2">
            <h3>{{ $p->title }}</h3>
            <p>{{ $p->description }}</p>
            <a href="{{ route('blog.show', $p) }}">Ir</a>
        </div>       
    @endforeach

    <br>
    {{ $posts->links() }}
    
</div>





