@csrf
<div class="form-group">
    <label for="id_usuario">Usuario que registró</label>
    <select name="id_usuario" class="form-control" required>
        <option value="">Seleccione...</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ old('id_usuario', $registro_biometrico->id_usuario ?? '') == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
        @endforeach
    </select>
    @error('id_usuario') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="id_persona">Persona asociada</label>
    <select name="id_persona" class="form-control" required>
        <option value="">Seleccione...</option>
        @foreach($personas as $persona)
            <option value="{{ $persona->id_persona }}" {{ old('id_persona', $registro_biometrico->id_persona ?? '') == $persona->id_persona ? 'selected' : '' }}>
                {{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}
            </option>
        @endforeach
    </select>
    @error('id_persona') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Etiqueta de Registro</label>
    <input type="text" name="etiqueta_registro" class="form-control"
           value="{{ old('etiqueta_registro', $registro_biometrico->etiqueta_registro ?? '') }}" required>
    @error('etiqueta_registro') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Fecha de Registro</label>
    <input type="date" name="fecha_registro" class="form-control"
           value="{{ old('fecha_registro', $registro_biometrico->fecha_registro ?? date('Y-m-d')) }}">
</div>

<div class="form-check mt-3">
    <input type="checkbox" name="activo" id="activo" class="form-check-input" value="1"
        {{ old('activo', $registro_biometrico->activo ?? true) ? 'checked' : '' }}>
    <label for="activo" class="form-check-label">Activo</label>
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('registro_biometrico.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
