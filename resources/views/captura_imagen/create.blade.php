<x-dashboard-layout>
    <div class="container">
        <h1>Registrar Nueva Captura</h1>
        <form action="{{ route('captura_imagen.store') }}" method="POST">
            @include('captura_imagen._form')
        </form>
    </div>
</x-dashboard-layout>
