<x-dashboard-layout>
    <div class="container">
        <h1>Registrar Ubicación</h1>
        <form action="{{ route('ubicaciones.store') }}" method="POST">
            @include('ubicaciones._form')
        </form>
    </div>
</x-dashboard-layout>
