<x-dashboard-layout>
    <div class="container">
        <h1>Nueva Persona</h1>
        <form action="{{ route('personas.store') }}" method="POST">
            @include('personas._form')
        </form>
    </div>
</x-dashboard-layout>
