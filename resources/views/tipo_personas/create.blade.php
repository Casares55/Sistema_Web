<x-dashboard-layout>
    <div class="container">
        <h1>Nuevo Tipo de Persona</h1>
        <form action="{{ route('tipo_personas.store') }}" method="POST">
            @include('tipo_personas._form')
        </form>
    </div>
</x-dashboard-layout>
