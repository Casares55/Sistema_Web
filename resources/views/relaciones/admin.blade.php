<x-dashboard-layout>
    <div class="container py-4">
        <h1 class="mb-3">Gestión de Relaciones Personales</h1>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Filtros --}}
        <form method="GET" class="mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Filtrar por estado</label>
                    <select name="estado" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Todos --</option>
                        <option value="Pendiente" {{ request('estado')=='Pendiente' ? 'selected' : '' }}>Pendientes</option>
                        <option value="Validado" {{ request('estado')=='Validado' ? 'selected' : '' }}>Validados</option>
                        <option value="Rechazado" {{ request('estado')=='Rechazado' ? 'selected' : '' }}>Rechazados</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">Filtrar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('relaciones.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
                </div>
            </div>
        </form>

        {{-- Tabla de relaciones --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tutor</th>
                    <th>Niño</th>
                    <th>Parentesco</th>
                    <th>Estado</th>
                    <th>Fecha registro</th>
                    <th>Fecha validación</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($relaciones as $relacion)
                    <tr>
                        <td>{{ $relacion->id_relacion }}</td>
                        <td>{{ $relacion->tutor->nombre }} {{ $relacion->tutor->apellido_paterno }}</td>
                        <td>{{ $relacion->nino->nombre }} {{ $relacion->nino->apellido_paterno }}</td>
                        <td>{{ $relacion->parentesco->descripcion }}</td>
                        <td>
                            @if($relacion->estado_validacion == 'Pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($relacion->estado_validacion == 'Validado')
                                <span class="badge bg-success">Validado</span>
                            @else
                                <span class="badge bg-danger">Rechazado</span>
                            @endif
                        </td>
                        <td>{{ $relacion->fecha_registro }}</td>
                        <td>{{ $relacion->fecha_validacion ?? '-' }}</td>
                        <td>
                            {{-- Botones para validar/rechazar --}}
                            @if($relacion->estado_validacion == 'Pendiente')
                                <form action="{{ route('relaciones.validar', $relacion) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <input type="hidden" name="accion" value="validar">
                                    <button type="submit" class="btn btn-sm btn-success">✔ Validar</button>
                                </form>
                                <form action="{{ route('relaciones.validar', $relacion) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <input type="hidden" name="accion" value="rechazar">
                                    <button type="submit" class="btn btn-sm btn-danger">✖ Rechazar</button>
                                </form>
                            @endif

                            {{-- Ver detalles --}}
                            <a href="{{ route('relaciones.show', $relacion) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Ver
                            </a>

                            {{-- Eliminar --}}
                            <form action="{{ route('relaciones.destroy', $relacion) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">🗑 Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No hay relaciones registradas.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $relaciones->links() }}
        </div>
    </div>
</x-dashboard-layout>
