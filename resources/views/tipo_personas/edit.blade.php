<x-dashboard-layout>
    <div class="container">
        <h1>Editar Tipo de Persona</h1>
        <form action="{{ route('tipo_personas.update', $tipo_persona) }}" method="POST">
            @method('PUT')
            @include('tipo_personas._form')
        </form>
    </div>
</x-dashboard-layout>
