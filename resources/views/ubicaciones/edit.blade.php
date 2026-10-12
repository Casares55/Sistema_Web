<x-dashboard-layout>
    <div class="container">
        <h1>Editar Ubicación</h1>
        <form action="{{ route('ubicaciones.update', $ubicacion) }}" method="POST">
            @method('PUT')
            @include('ubicaciones._form')
        </form>
    </div>
</x-dashboard-layout>
