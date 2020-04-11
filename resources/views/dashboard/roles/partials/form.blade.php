<div class="form-group">
    <label for="name">Nombre</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $role->name) }}">
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descrición</label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $role->description) }}</textarea>
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    @php
    $role_permissions = $role->getPermissionNames()->toArray();
    @endphp
    @foreach($permissions as $name => $description)
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" name="permissions[]" {{ !in_array($name, $role_permissions) ? : 'checked'}} value="{{ $name }}" id="{{ $name }}">
        <label class="custom-control-label" for="{{ $name }}">{{ $description }}</label>
    </div>
    @endforeach
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
