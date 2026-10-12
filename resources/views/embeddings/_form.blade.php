@csrf

<div class="form-group">
    <label for="id_imagen">Imagen (captura)</label>
    <select name="id_imagen" class="form-control" required>
        <option value="">-- Selecciona una imagen --</option>
        @foreach($imagenes as $img)
            <option value="{{ $img->id_imagen }}"
                {{ old('id_imagen', $embedding->id_imagen ?? '') == $img->id_imagen ? 'selected' : '' }}>
                {{ $img->id_imagen }} — {{ \Illuminate\Support\Str::limit($img->ruta_imagen, 60) }}
            </option>
        @endforeach
    </select>
    @error('id_imagen') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-group mt-2">
    <label for="vector_embedding">Vector (JSON o base64)</label>
    <textarea name="vector_embedding" class="form-control" rows="6" required>{{ old('vector_embedding', $embedding->vector_embedding ?? '') }}</textarea>
    <small class="form-text text-muted">Almacena el vector como JSON (ej: [0.12,0.34,...]) o como string serializado.</small>
    @error('vector_embedding') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary mt-3" type="submit">Guardar</button>
<a href="{{ route('embeddings.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
