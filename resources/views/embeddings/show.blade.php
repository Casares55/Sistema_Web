<x-dashboard-layout>
    <div class="container">
        <h1>Detalle Embedding #{{ $embedding->id_embedding }}</h1>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>ID Imagen:</strong> {{ $embedding->id_imagen }}</p>
                <p><strong>Ruta imagen:</strong> {{ $embedding->imagen->ruta_imagen ?? 'N/A' }}</p>
                <p><strong>Fecha creación:</strong> {{ $embedding->fecha_creacion?->format('d/m/Y H:i') }}</p>
                <p><strong>Vector:</strong></p>
                <pre style="max-height:400px;overflow:auto;white-space:pre-wrap">{{ $embedding->vector_embedding }}</pre>
            </div>
        </div>

        <a href="{{ route('embeddings.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('embeddings.edit', $embedding) }}" class="btn btn-info">Editar</a>
        <form action="{{ route('embeddings.destroy', $embedding) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este embedding?');">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</x-dashboard-layout>
