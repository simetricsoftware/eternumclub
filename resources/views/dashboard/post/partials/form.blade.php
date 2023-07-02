<div class="form-group">
    <label for="title">Titulo</label>
    <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
    @error('title')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="slug">Url amigable</label>
    <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
    @error('slug')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="content">Contenido</label>
    <input type="hidden" id="content" name="content" value="{{ old('content', $post->content) }}">
    <div id="editor-container"></div>
    @error('content')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="category_id">Categoria</label>
    <select class="form-control" id="category_id" name="category_id">
        @foreach($categories as $id => $title)
        <option value="{{ $id }}" {{ old('category_id', $post->category_id) != $id ? : 'selected'}} >{{ $title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="status">Estado</label>
    <select class="form-control" id="status" name="status">
        <option {{ old('status', $post->status) !== 'unposted' ? : 'selected'}} value="unposted">No Posteado</option>
        <option {{ old('status', $post->status) !== 'posted' ? : 'selected'}} value="posted">Posteado</option>
    </select>
</div>
<div class="form-group">
    @php
    $post_tags = $post->tags->pluck('id')->toArray()
    @endphp
    <label for="tags">Etiquetas</label>
    <select class="form-control" name="tags[]" multiple>
        @foreach($tags as $id => $name)
        <option value="{{ $id }}" {{ !in_array($id, old('tags', $post_tags)) ? : 'selected'}}>{{ $name }}</option>
        @endforeach
    </select>
    <span>Presiona ctrl+clic para seleccionar varios</span>
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
