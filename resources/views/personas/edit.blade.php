<x-dashboard-layout>
    <div class="container">
        <h1>Editar Persona</h1>
        <form action="{{ route('personas.update', $persona) }}" method="POST">
            @method('PUT')
            @include('personas._form')
        </form>
    </div>
</x-dashboard-layout>
