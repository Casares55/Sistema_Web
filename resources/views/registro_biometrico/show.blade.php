<x-dashboard-layout>
    <div class="container">
        <h1>Detalle del Registro Biométrico</h1>
        <p><strong>ID:</strong> {{ $registro_biometrico->id_registro }}</p>
        <p><strong>Usuario:</strong> {{ $registro_biometrico->usuario->nombre ?? '-' }}</p>
        <p><strong>Persona:</strong> {{ $registro_biometrico->persona->nombre ?? '-' }}</p>
        <p><strong>Etiqueta:</strong> {{ $registro_biometrico->etiqueta_registro }}</p>
        <p><strong>Fecha de Registro:</strong> {{ $registro_biometrico->fecha_registro }}</p>
        <p><strong>Activo:</strong> {{ $registro_biometrico->activo ? 'Sí' : 'No' }}</p>

        <a href="{{ route('registro_biometrico.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</x-dashboard-layout>
