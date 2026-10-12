@csrf

<div class="form-group">
    <label>Persona</label>
    <select name="id_persona" class="form-control" required>
        <option value="">-- Selecciona persona --</option>
        @foreach($personas as $p)
            <option value="{{ $p->id_persona }}" {{ old('id_persona', $evento->id_persona ?? '') == $p->id_persona ? 'selected' : '' }}>
                {{ $p->nombre }} {{ $p->apellido_paterno }}
            </option>
        @endforeach
    </select>
    @error('id_persona') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label>Dispositivo</label>
    <select name="id_dispositivo" class="form-control" required>
        <option value="">-- Selecciona dispositivo --</option>
        @foreach($dispositivos as $d)
            <option value="{{ $d->id_dispositivo }}" {{ old('id_dispositivo', $evento->id_dispositivo ?? '') == $d->id_dispositivo ? 'selected' : '' }}>
                {{ $d->descripcion }}
            </option>
        @endforeach
    </select>
    @error('id_dispositivo') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label>Embedding</label>
    <select name="id_embedding" class="form-control" required>
        <option value="">-- Selecciona embedding --</option>
        @foreach($embeddings as $e)
            <option value="{{ $e->id_embedding }}" {{ old('id_embedding', $evento->id_embedding ?? '') == $e->id_embedding ? 'selected' : '' }}>
                Embedding #{{ $e->id_embedding }}
            </option>
        @endforeach
    </select>
    @error('id_embedding') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label>Tipo de Evento</label>
    <select name="id_tipoevento" class="form-control" required>
        <option value="">-- Selecciona tipo --</option>
        @foreach($tipos as $t)
            <option value="{{ $t->id_tipoevento }}" {{ old('id_tipoevento', $evento->id_tipoevento ?? '') == $t->id_tipoevento ? 'selected' : '' }}>
                {{ $t->descripcion }}
            </option>
        @endforeach
    </select>
    @error('id_tipoevento') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label>Confianza (%)</label>
    <input type="number" name="confianza" step="0.01" min="0" max="100" class="form-control"
           value="{{ old('confianza', $evento->confianza ?? '') }}">
    @error('confianza') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label>Resultado</label>
    <input type="text" name="resultado" class="form-control" value="{{ old('resultado', $evento->resultado ?? '') }}">
    @error('resultado') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary mt-3">Guardar</button>
<a href="{{ route('eventos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
