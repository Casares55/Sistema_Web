<x-dashboard-layout>
    <div class="container">
        <h1>Detalle del Tipo de Persona</h1>
        <p><strong>ID:</strong> {{ $tipo_persona->id_tipopersona }}</p>
        <p><strong>Descripción:</strong> {{ $tipo_persona->descripcion }}</p>
        <a href="{{ route('tipo_personas.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</x-dashboard-layout>
