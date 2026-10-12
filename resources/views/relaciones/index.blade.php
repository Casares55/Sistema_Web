<x-dashboard-layout>
    <div class="container py-4">
        <h1 class="mb-3">Asignación de Parentescos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulario para agregar relación --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">Nueva relación</div>
            <div class="card-body">
                <form method="POST" action="{{ route('relaciones.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tutor</label>
                            <select name="id_tutor" class="form-select" required>
                                <option value="">-- Selecciona tutor --</option>
                                @foreach($personas as $p)
                                    <option value="{{ $p->id_persona }}">{{ $p->nombre }} {{ $p->apellido_paterno }} {{ $p->apellido_materno }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Niño(a)</label>
                            <select name="id_nino" class="form-select" required>
                                <option value="">-- Selecciona niño(a) --</option>
                                @foreach($personas as $p)
                                    <option value="{{ $p->id_persona }}">{{ $p->nombre }} {{ $p->apellido_paterno }} {{ $p->apellido_materno }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Parentesco</label>
                            <select name="id_parentesco" class="form-select" required>
                                <option value="">-- Selecciona parentesco --</option>
                                @foreach($parentescos as $par)
                                    <option value="{{ $par->id_parentesco }}">{{ $par->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary">Guardar relación</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabla de relaciones existentes --}}
        <div class="table-responsive shadow-sm">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tutor</th>
                    <th>Niño</th>
                    <th>Parentesco</th>
                    <th>Estado</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($relaciones as $relacion)
                    <tr>
                        <td>{{ $relacion->id_relacion }}</td>
                        <td>{{ $relacion->tutor->nombre ?? '—' }} {{ $relacion->tutor->apellido_paterno ?? '—' }} {{ $relacion->tutor->apellido_materno ?? '—' }}</td>
                        <td>{{ $relacion->nino->nombre ?? '—' }} {{ $relacion->nino->apellido_paterno ?? '—' }} {{ $relacion->nino->apellido_materno ?? '—' }}</td>
                        <td>{{ $relacion->parentesco->descripcion ?? '—' }} </td>
                        <td>
                            @if($relacion->estado_validacion == 'Validado')
                                <span class="badge bg-success">Validado</span>
                            @elseif($relacion->estado_validacion == 'Pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @else
                                <span class="badge bg-danger">Rechazado</span>
                            @endif
                        </td>
                        <td>{{ $relacion->fecha_registro }}</td>
                        <td>
                            <form action="{{ route('relaciones.destroy', $relacion) }}" method="POST" onsubmit="return confirm('¿Eliminar relación?')" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">🗑</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No hay relaciones registradas.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $relaciones->links() }}
        </div>
    </div>
</x-dashboard-layout>
