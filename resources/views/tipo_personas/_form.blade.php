@csrf
<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" class="form-control"
           value="{{ old('descripcion', $tipo_persona->descripcion ?? '') }}" required>
    @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<button class="btn btn-primary" type="submit">Guardar</button>
<a href="{{ route('tipo_personas.index') }}" class="btn btn-secondary">Cancelar</a>
