<x-dashboard-layout>
    <div class="container">
        <h1>Dispositivos Registrados</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('dispositivos.create') }}" class="btn btn-primary mb-3">Nuevo Dispositivo</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Código Interno</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Dirección IP</th>
                <th>Tipo</th>
                <th>Estatus</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dispositivos as $dispositivo)
                <tr>
                    <td>{{ $dispositivo->id_dispositivo }}</td>
                    <td>{{ $dispositivo->codigo_interno }}</td>
                    <td>{{ $dispositivo->descripcion }}</td>
                    <td>{{ $dispositivo->ubicacion->descripcion ?? 'N/A' }}</td>
                    <td>{{ $dispositivo->direccion_ip }}</td>
                    <td>{{ $dispositivo->tipoDispositivo->descripcion ?? 'N/A' }}</td>
                    <td>{{ $dispositivo->estatus ? 'Activo' : 'Inactivo' }}</td>
                    <td>{{ $dispositivo->fecha_creacion ? $dispositivo->fecha_creacion->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('dispositivos.show', $dispositivo) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('dispositivos.edit', $dispositivo) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('dispositivos.destroy', $dispositivo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar dispositivo?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $dispositivos->links() }}
    </div>
</x-dashboard-layout>
