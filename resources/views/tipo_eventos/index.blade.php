<x-dashboard-layout>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tipos de Eventos</h1>
        <p class="mb-4">Lista de todos los tipos de eventos registrados en el sistema.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Tipos de Eventos</h6>
                <a href="{{ route('tipo_eventos.create') }}" class="btn btn-primary btn-sm">Nuevo Tipo de Evento</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th style="width: 180px;">Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($tipos as $t)
                            <tr>
                                <td>{{ $t->id_tipoevento }}</td>
                                <td>{{ $t->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tipo_eventos.edit', $t) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('tipo_eventos.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este tipo de evento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No hay registros</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-3">
                    {{ $tipos->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</x-dashboard-layout>
