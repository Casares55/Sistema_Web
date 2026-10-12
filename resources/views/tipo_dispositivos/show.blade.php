<x-dashboard-layout>
    <div class="container">
        <h1>Detalle del Tipo de Dispositivo</h1>
        <p><strong>ID:</strong> {{ $tipo_dispositivo->id_tipodispositivo }}</p>
        <p><strong>Descripción:</strong> {{ $tipo_dispositivo->descripcion }}</p>

        <a href="{{ route('tipo_dispositivos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</x-dashboard-layout>
