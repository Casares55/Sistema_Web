<x-dashboard-layout>
    <div class="container">
        <h1>Nuevo Tipo de Dispositivo</h1>
        <form action="{{ route('tipo_dispositivos.store') }}" method="POST">
            @include('tipo_dispositivos._form')
        </form>
    </div>
</x-dashboard-layout>
