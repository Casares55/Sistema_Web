<x-dashboard-layout>
    <div class="container">
        <h1>Editar Dispositivo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups...</strong> Revisa los errores antes de continuar.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dispositivos.update', $dispositivo) }}" method="POST">
            @method('PUT')
            @include('dispositivos._form')
        </form>
    </div>
</x-dashboard-layout>
