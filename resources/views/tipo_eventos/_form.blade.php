@csrf
<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $tipo_evento->descripcion ?? '') }}" required>
</div>
<button class="btn btn-primary mt-2">Guardar</button>
<a href="{{ route('tipo_eventos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
