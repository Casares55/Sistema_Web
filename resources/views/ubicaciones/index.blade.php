<x-dashboard-layout>
    <div class="container">
        <h1>Ubicaciones Registradas</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('ubicaciones.create') }}" class="btn btn-primary mb-3">Nueva Ubicación</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ubicaciones as $ubicacion)
                <tr>
                    <td>{{ $ubicacion->id_ubicacion }}</td>
                    <td>{{ $ubicacion->descripcion }}</td>
                    <td>
                        <a href="{{ route('ubicaciones.show', $ubicacion) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('ubicaciones.edit', $ubicacion) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('ubicaciones.destroy', $ubicacion) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar ubicación?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $ubicaciones->links() }}
    </div>
</x-dashboard-layout>
