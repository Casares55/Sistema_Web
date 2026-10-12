<x-dashboard-layout>
    <div class="container">
        <h1>Nuevo Registro Biométrico</h1>
        <form action="{{ route('registro_biometrico.store') }}" method="POST">
            @include('registro_biometrico._form')
        </form>
    </div>
</x-dashboard-layout>
