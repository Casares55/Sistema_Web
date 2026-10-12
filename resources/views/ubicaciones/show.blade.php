<x-dashboard-layout>
    <div class="container">
        <h1>Detalle de la Ubicación</h1>
        <p><strong>ID:</strong> {{ $ubicacion->id_ubicacion }}</p>
        <p><strong>Descripción:</strong> {{ $ubicacion->descripcion }}</p>

        <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</x-dashboard-layout>
