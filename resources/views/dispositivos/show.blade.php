<x-dashboard-layout>
    <div class="container">
        <h1>Detalle del Dispositivo</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $dispositivo->id_dispositivo }}</p>
                <p><strong>Código Interno:</strong> {{ $dispositivo->codigo_interno }}</p>
                <p><strong>Descripción:</strong> {{ $dispositivo->descripcion }}</p>
                <p><strong>Ubicación:</strong> {{ $dispositivo->ubicacion->descripcion ?? 'N/A' }}</p>
                <p><strong>Dirección IP:</strong> {{ $dispositivo->direccion_ip }}</p>
                <p><strong>Tipo de Dispositivo:</strong> {{ $dispositivo->tipoDispositivo->descripcion ?? 'N/A' }}</p>
                <p><strong>Estatus:</strong>
                    @if($dispositivo->estatus)
                        <span class="badge bg-success text-white">Activo</span>
                    @else
                        <span class="badge bg-danger text-white">Inactivo</span>
                    @endif
                </p>
                <p><strong>Fecha de Creación:</strong>
                    {{ $dispositivo->fecha_creacion ? $dispositivo->fecha_creacion->format('d/m/Y H:i') : '-' }}
                </p>
            </div>
        </div>

        <a href="{{ route('dispositivos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('dispositivos.edit', $dispositivo) }}" class="btn btn-info">Editar</a>
        <form action="{{ route('dispositivos.destroy', $dispositivo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este dispositivo?');">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</x-dashboard-layout>
