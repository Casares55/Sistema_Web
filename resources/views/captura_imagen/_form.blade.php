@csrf
<div class="form-group">
    <label for="id_dispositivo">Dispositivo</label>
    <select name="id_dispositivo" class="form-control" required>
        <option value="">-- Selecciona un dispositivo --</option>
        @foreach($dispositivos as $d)
            <option value="{{ $d->id_dispositivo }}"
                {{ old('id_dispositivo', $captura_imagen->id_dispositivo ?? '') == $d->id_dispositivo ? 'selected' : '' }}>
                {{ $d->descripcion }} ({{ $d->direccion_ip }})
            </option>
        @endforeach
    </select>
    @error('id_dispositivo') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="id_registro">Registro Biométrico</label>
    <select name="id_registro" class="form-control" required>
        <option value="">-- Selecciona un registro --</option>
        @foreach($registros as $r)
            <option value="{{ $r->id_registro }}"
                {{ old('id_registro', $captura_imagen->id_registro ?? '') == $r->id_registro ? 'selected' : '' }}>
                {{ $r->etiqueta_registro }}
            </option>
        @endforeach
    </select>
    @error('id_registro') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="ruta_imagen">Ruta de Imagen</label>
    <input type="text" name="ruta_imagen" class="form-control"
           value="{{ old('ruta_imagen', $captura_imagen->ruta_imagen ?? '') }}" required>
    @error('ruta_imagen') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="hash_imagen">Hash de Imagen</label>
    <input type="text" name="hash_imagen" class="form-control"
           value="{{ old('hash_imagen', $captura_imagen->hash_imagen ?? '') }}" required>
    @error('hash_imagen') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('captura_imagen.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
