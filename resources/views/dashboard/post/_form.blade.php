
    {{-- token proteccion CSRF (Cross-Site Request Forgery) --}}
    @csrf

    <label for="title">Título</label>
    <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">

    <label for="slug">Slug</label>
    <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">

    <label for="content">Contenido</label>
    <textarea class="form-control" name="content" id="content">{{ old('content', $post->content) }}</textarea>

    <label for="category_id">Categoría</label>
    <select class="form-control" name="category_id" id="category_id">
        @foreach ($categories as $title => $id)
            <option {{ old('category_id', $post->category_id) == $id ? "selected":"" }} value="{{$id}}">{{$title}}</option>
        @endforeach
    </select>

    <label for="description">Descripción</label>
    <textarea class="form-control" name="description" id="description">{{ old('description', $post->description) }}</textarea>

    <label for="posted">Posteado</label>
    <select class="form-control" name="posted" id="posted">
        <option {{ old('posted', $post->posted) == 'yes' ? "selected":"" }} value="yes">Si</option>
        <option {{ old('posted', $post->posted) == null || $post->posted == 'not' ? "selected":"" }} value="not">No</option>
    </select>

    @if (isset($task) && $task == 'edit')
        <label for="image">Imagen</label>
        <input type="file" name="image" id="image">
    @endif

    <button class="btn btn-success mt-2" type="submit">Enviar</button>
