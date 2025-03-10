
    {{-- token proteccion CSRF (Cross-Site Request Forgery) --}}
    @csrf

    <label for="title">Título</label>
    <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $category->title) }}">

    <label for="slug">Slug</label>
    <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">

    <button  class="btn btn-success mt-2" type="submit">Enviar</button>
