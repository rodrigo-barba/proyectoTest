
    {{-- token proteccion CSRF (Cross-Site Request Forgery) --}}
    @csrf

    <label for="title">Título</label>
    <input type="text" name="title" id="title" value="{{ old('title', $category->title) }}">

    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">

    <button type="submit">Enviar</button>
