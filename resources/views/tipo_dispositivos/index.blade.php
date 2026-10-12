<x-dashboard-layout>
        <h1>Tipos de Dispositivos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('tipo_dispositivos.create') }}" class="btn btn-primary mb-3">Nuevo Tipo</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->id_tipodispositivo }}</td>
                    <td>{{ $tipo->descripcion }}</td>
                    <td>
                        <a href="{{ route('tipo_dispositivos.show', $tipo) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('tipo_dispositivos.edit', $tipo) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('tipo_dispositivos.destroy', $tipo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar tipo de dispositivo?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tipos->links() }}
</x-dashboard-layout>
