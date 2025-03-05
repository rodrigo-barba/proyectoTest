
    {{-- token proteccion CSRF (Cross-Site Request Forgery) --}}
    @csrf

    <label for="title">Título</label>
    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">

    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">

    <label for="content">Contenido</label>
    <textarea name="content" id="content">{{ old('content', $post->content) }}</textarea>

    <label for="category_id">Categoría</label>
    <select name="category_id" id="category_id">
        @foreach ($categories as $title => $id)
            <option {{ old('category_id', $post->category_id) == $id ? "selected":"" }} value="{{$id}}">{{$title}}</option>
        @endforeach
    </select>

    <label for="description">Descripción</label>
    <textarea name="description" id="description">{{ old('description', $post->description) }}</textarea>

    <label for="posted">Posteado</label>
    <select name="posted" id="posted">
        <option {{ old('posted', $post->posted) == 'yes' ? "selected":"" }} value="yes">Si</option>
        <option {{ old('posted', $post->posted) == null || $post->posted == 'not' ? "selected":"" }} value="not">No</option>
    </select>

    @if (isset($task) && $task == 'edit')
        <label for="image">Imagen</label>
        <input type="file" name="image" id="image">
    @endif

    <button type="submit">Enviar</button>
