<x-dashboard-layout>
    <div class="container">
        <h1>Editar Tipo de Dispositivo</h1>
        <form action="{{ route('tipo_dispositivos.update', $tipo_dispositivo) }}" method="POST">
            @method('PUT')
            @include('tipo_dispositivos._form')
        </form>
    </div>
</x-dashboard-layout>
