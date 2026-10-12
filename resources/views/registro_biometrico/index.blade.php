<x-dashboard-layout>
    <div class="container">
        <h1>Registros Biométricos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('registro_biometrico.create') }}" class="btn btn-primary mb-3">Nuevo Registro</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Persona</th>
                <th>Etiqueta</th>
                <th>Fecha</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->id_registro }}</td>
                    <td>{{ $registro->usuario->nombre ?? '-' }}</td>
                    <td>{{ $registro->persona->nombre ?? '-' }}</td>
                    <td>{{ $registro->etiqueta_registro }}</td>
                    <td>{{ $registro->fecha_registro }}</td>
                    <td>{{ $registro->activo ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('registro_biometrico.show', $registro) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('registro_biometrico.edit', $registro) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('registro_biometrico.destroy', $registro) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar registro?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $registros->links() }}
    </div>
</x-dashboard-layout>
