<x-dashboard-layout>
    <div class="container">
        <h1>Detalle de la Captura</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $captura_imagen->id_imagen }}</p>
                <p><strong>Dispositivo:</strong> {{ $captura_imagen->dispositivo->descripcion ?? 'N/A' }}</p>
                <p><strong>Registro Biométrico:</strong> {{ $captura_imagen->registroBiometrico->etiqueta_registro ?? 'N/A' }}</p>
                <p><strong>Ruta Imagen:</strong> {{ $captura_imagen->ruta_imagen }}</p>
                <p><strong>Hash Imagen:</strong> {{ $captura_imagen->hash_imagen }}</p>
                <p><strong>Fecha Captura:</strong> {{ $captura_imagen->fecha_captura?->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <a href="{{ route('captura_imagen.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('captura_imagen.edit', $captura_imagen) }}" class="btn btn-info">Editar</a>
        <form action="{{ route('captura_imagen.destroy', $captura_imagen) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta captura?');">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</x-dashboard-layout>
