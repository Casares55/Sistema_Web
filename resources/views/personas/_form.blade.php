@csrf
<div class="form-group">
    <label for="id_tipopersona">Tipo de Persona</label>
    <select name="id_tipopersona" class="form-control" required>
        <option value="">Seleccione...</option>
        @foreach($tipos as $id => $desc)
            <option value="{{ $id }}" {{ old('id_tipopersona', $persona->id_tipopersona ?? '') == $id ? 'selected' : '' }}>
                {{ $desc }}
            </option>
        @endforeach
    </select>
    @error('id_tipopersona') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-row">
    <div class="col-md-4">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $persona->nombre ?? '') }}" required>
        @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label>Apellido Paterno</label>
        <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', $persona->apellido_paterno ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Apellido Materno</label>
        <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', $persona->apellido_materno ?? '') }}">
    </div>
</div>

<div class="form-row mt-3">
    <div class="col-md-4">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $persona->telefono ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Correo</label>
        <input type="email" name="correo" class="form-control" value="{{ old('correo', $persona->correo ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Fecha de Registro</label>
        <input type="date" name="fecha_registro" class="form-control" value="{{ old('fecha_registro', isset($persona) ? $persona->fecha_registro : date('Y-m-d')) }}">
    </div>
</div>

<div class="form-group mt-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $persona->direccion ?? '') }}">
</div>

<div class="form-check mt-2">
    <input type="checkbox" name="estado" id="estado" class="form-check-input" value="1"
        {{ old('estado', $persona->estado ?? true) ? 'checked' : '' }}>
    <label for="estado" class="form-check-label">Activo</label>
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('personas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
