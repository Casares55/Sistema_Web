<x-dashboard-layout>
    <div class="container">
        <h1>Editar Captura de Imagen</h1>
        <form action="{{ route('captura_imagen.update', $captura_imagen) }}" method="POST">
            @method('PUT')
            @include('captura_imagen._form')
        </form>
    </div>
</x-dashboard-layout>
