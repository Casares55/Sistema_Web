@csrf
<div class="form-group">
    <label for="codigo_interno">Código Interno</label>
    <input type="text" name="codigo_interno" class="form-control"
           value="{{ old('codigo_interno', $dispositivo->codigo_interno ?? '') }}" required>
    @error('codigo_interno') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" class="form-control"
           value="{{ old('descripcion', $dispositivo->descripcion ?? '') }}" required>
    @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="id_ubicacion">Ubicación</label>
    <select name="id_ubicacion" class="form-control" required>
        <option value="">-- Selecciona una ubicación --</option>
        @foreach($ubicaciones as $ubicacion)
            <option value="{{ $ubicacion->id_ubicacion }}"
                {{ old('id_ubicacion', $dispositivo->id_ubicacion ?? '') == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                {{ $ubicacion->descripcion }}
            </option>
        @endforeach
    </select>
    @error('id_ubicacion') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="direccion_ip">Dirección IP</label>
    <input type="text" name="direccion_ip" class="form-control"
           value="{{ old('direccion_ip', $dispositivo->direccion_ip ?? '') }}" required>
    @error('direccion_ip') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="id_tipodispositivo">Tipo de Dispositivo</label>
    <select name="id_tipodispositivo" class="form-control" required>
        <option value="">-- Selecciona un tipo --</option>
        @foreach($tipos as $tipo)
            <option value="{{ $tipo->id_tipodispositivo }}"
                {{ old('id_tipodispositivo', $dispositivo->id_tipodispositivo ?? '') == $tipo->id_tipodispositivo ? 'selected' : '' }}>
                {{ $tipo->descripcion }}
            </option>
        @endforeach
    </select>
    @error('id_tipodispositivo') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-check mt-3">
    <input type="checkbox" name="estatus" id="estatus" class="form-check-input" value="1"
        {{ old('estatus', $dispositivo->estatus ?? true) ? 'checked' : '' }}>
    <label for="estatus" class="form-check-label">Activo</label>
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('dispositivos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
