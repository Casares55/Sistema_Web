<x-dashboard-layout>
    <div class="container">
        <h1>Editar Tipo de Evento</h1>
        <form action="{{ route('tipo_eventos.update', $tipo_evento) }}" method="POST">
            @method('PUT')
            @include('tipo_eventos._form')
        </form>
    </div>
</x-dashboard-layout>
