<x-dashboard-layout>
    <div class="container">
        <h1>Nuevo Tipo de Evento</h1>
        <form action="{{ route('tipo_eventos.store') }}" method="POST">
            @include('tipo_eventos._form')
        </form>
    </div>
</x-dashboard-layout>
