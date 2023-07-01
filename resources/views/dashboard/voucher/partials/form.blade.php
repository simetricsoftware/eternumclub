<div class="form-group">
    <label for="name">Tipo de entrada *</label>
    <input class="form-control" type="text" id="name" name="name" placeholder="ej. General, VIP, etc" value="{{ old('name', $ticketType->name) }}">
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
    <label for="quantity">Cantidad (Min: 20, Max 500) *</label>
    <input class="form-control" type="number" id="quantity" name="quantity" min="20" max="500" value="{{ old('quantity', $ticketType->quantity) }}">
    @error('quantity')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<input class="btn btn-primary" type="submit" name="save" value="Guardar">
