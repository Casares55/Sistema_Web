<x-dashboard-layout>
    <div class="container">
        <h1>Nuevo Embedding</h1>
        <form action="{{ route('embeddings.store') }}" method="POST">
            @include('embeddings._form')
        </form>
    </div>
</x-dashboard-layout>
