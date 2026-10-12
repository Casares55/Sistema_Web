<x-dashboard-layout>
    <div class="container">
        <h1>Editar Embedding</h1>
        <form action="{{ route('embeddings.update', $embedding) }}" method="POST">
            @method('PUT')
            @include('embeddings._form')
        </form>
    </div>
</x-dashboard-layout>
