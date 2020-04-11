<div class="form-group">
    <label for="name">Nombre</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $tag->name) }}">
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
