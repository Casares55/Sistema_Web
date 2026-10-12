<x-dashboard-layout>
    <div class="container">
        <h1>Registrar Nuevo Evento</h1>
        <form action="{{ route('eventos.store') }}" method="POST">
            @include('eventos._form')
        </form>
    </div>
</x-dashboard-layout>
