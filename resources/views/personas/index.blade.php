<x-dashboard-layout>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Personas Registradas</h1>
        <p class="mb-4">Lista de todas las personas registradas en el sistema.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Personas</h6>
                <a href="{{ route('registro_biometrico.create') }}" class="btn btn-primary btn-sm">Nuevo registro</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($personas as $persona)
                            <tr>
                                <td>{{ $persona->id_persona }}</td>
                                <td>{{ $persona->tipoPersona->descripcion ?? '-' }}</td>
                                <td>{{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
                                <td>{{ $persona->correo ?? '-' }}</td>
                                <td>{{ $persona->telefono ?? '-' }}</td>
                                <td>
                                        <span class="badge {{ $persona->estado ? 'badge-success' : 'badge-danger' }}">
                                            {{ $persona->estado ? 'Activo' : 'Inactivo' }}
                                        </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('personas.show', $persona) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('personas.edit', $persona) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('personas.destroy', $persona) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar persona?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-3">
                    {{ $personas->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</x-dashboard-layout>
