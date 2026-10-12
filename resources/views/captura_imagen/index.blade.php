<x-dashboard-layout>
        <h1>Capturas de Imágenes</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('captura_imagen.create') }}" class="btn btn-primary mb-3">Nueva Captura</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Dispositivo</th>
                <th>Registro Biométrico</th>
                <th>Ruta Imagen</th>
                <th>Hash Imagen</th>
                <th>Fecha Captura</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($imagenes as $img)
                <tr>
                    <td>{{ $img->id_imagen }}</td>
                    <td>{{ $img->dispositivo->descripcion ?? 'N/A' }}</td>
                    <td>{{ $img->registroBiometrico->etiqueta_registro ?? 'N/A' }}</td>
                    <td>{{ $img->ruta_imagen }}</td>
                    <td>{{ Str::limit($img->hash_imagen, 20) }}</td>
                    <td>{{ $img->fecha_captura ? $img->fecha_captura->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('captura_imagen.show', $img) }}" class="btn btn-sm btn-secondary">Ver</a>
                        <a href="{{ route('captura_imagen.edit', $img) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('captura_imagen.destroy', $img) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta captura?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $imagenes->links() }}
</x-dashboard-layout>
