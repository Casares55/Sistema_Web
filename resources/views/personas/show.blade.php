<x-dashboard-layout>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Detalle de Persona</h1>
        <p class="mb-4">Información detallada de la persona seleccionada.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}
                </h6>
                <a href="{{ route('personas.index') }}" class="btn btn-secondary btn-sm">Volver</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $persona->id_persona }}</td>
                    </tr>
                    <tr>
                        <th>Tipo</th>
                        <td>{{ $persona->tipoPersona->descripcion ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{ $persona->correo ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td>{{ $persona->telefono ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            <span class="badge {{ $persona->estado ? 'badge-success' : 'badge-danger' }}">
                                {{ $persona->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Registrado el</th>
                        <td>{{ \Carbon\Carbon::parse($persona->fecha_registro)->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('personas.edit', $persona) }}" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-edit"></i> Editar
                    </a>

                    <form action="{{ route('personas.destroy', $persona) }}" method="POST" onsubmit="return confirm('¿Eliminar persona?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
