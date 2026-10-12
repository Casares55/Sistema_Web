<x-dashboard-layout>
    <div class="container">
        <h1>Embeddings</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('embeddings.create') }}" class="btn btn-primary mb-3">Nuevo Embedding</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Preview vector</th>
                <th>Fecha creación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($embeddings as $e)
                <tr>
                    <td>{{ $e->id_embedding }}</td>
                    <td>
                        @if($e->imagen)
                            <a href="{{ route('captura_imagen.show', $e->imagen) }}">
                                {{ \Illuminate\Support\Str::limit($e->imagen->ruta_imagen, 40) }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td><pre style="max-width:320px;white-space:nowrap;overflow:auto">{{ \Illuminate\Support\Str::limit($e->vector_embedding, 80) }}</pre></td>
                    <td>{{ $e->fecha_creacion?->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('embeddings.show', $e) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('embeddings.edit', $e) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('embeddings.destroy', $e) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este embedding?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $embeddings->links() }}
    </div>
</x-dashboard-layout>
