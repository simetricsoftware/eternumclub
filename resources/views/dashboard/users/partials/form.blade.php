<div class="form-group">
    <label for="name">Nombre</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="lastname">Nombre</label>
    <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
    @error('lastname')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="password">Contraseña</label>
    <input class="form-control" type="password" id="password" name="password" value="">
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@isset($edit)
<div class="form-group">
    <label for="role">Rol</label>
    <select class="form-control" id="role" name="role">
        @foreach($roles as $name => $description)
        <option {{$user->getRoleNames()->first() !== $name ? : 'selected'}} value="{{ $name }}">{{ $description }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    @php
    $role_permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
    $user_permissions = $user->getPermissionNames()->toArray();
    @endphp
    @foreach($permissions as $name => $description)
    <div class="custom-control custom-checkbox">
        @if( in_array($name, $role_permissions) )
        <input class="custom-control-input" type="checkbox" checked disabled id="{{ $name }}">
        @else
        <input class="custom-control-input" type="checkbox" name="permissions[]" {{ !in_array($name, $user_permissions) ? : 'checked'}} value="{{ $name }}" id="{{ $name }}">
        @endif
        <label class="custom-control-label" for="{{ $name }}">{{ $description }}</label>
    </div>
    @endforeach
</div>
@endisset
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
