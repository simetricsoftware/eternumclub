<div class="form-group">
    <label for="title">Titulo</label>
    <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $category->title) }}">
    @error('title')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="slug">Url amigable</label>
    <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
    @error('slug')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
