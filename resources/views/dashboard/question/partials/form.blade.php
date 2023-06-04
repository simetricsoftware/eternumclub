<div class="form-group">
    <label for="name">Nombre *</label>
    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $ticketType->name) }}">
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="amount">Valor *</label>
    <input class="form-control" type="number" id="amount" name="amount" step="0.01" value="{{ old('amount', $ticketType->amount) }}">
    @error('amount')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="quantity">Cantidad (0 para ilimitado) *</label>
    <input class="form-control" type="number" id="quantity" name="quantity" value="{{ old('quantity', $ticketType->quantity) }}">
    @error('quantity')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
