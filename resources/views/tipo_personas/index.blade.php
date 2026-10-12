<x-dashboard-layout>
    <div class="container">
        <h1>Tipos de Persona</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('tipo_personas.create') }}" class="btn btn-primary mb-3">Nuevo tipo</a>

        <table class="table table-bordered">
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
                    <td>{{ $tipo->id_tipopersona }}</td>
                    <td>{{ $tipo->descripcion }}</td>
                    <td>
                        <a href="{{ route('tipo_personas.show', $tipo) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('tipo_personas.edit', $tipo) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('tipo_personas.destroy', $tipo) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Deseas eliminar este tipo de persona?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tipos->links() }}
    </div>
</x-dashboard-layout>
