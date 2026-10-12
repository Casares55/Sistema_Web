@csrf
<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" class="form-control"
           value="{{ old('descripcion', $tipo_dispositivo->descripcion ?? '') }}" required>
    @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('tipo_dispositivos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
