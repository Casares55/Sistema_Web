<x-dashboard-layout>
        <div class="container-fluid">
            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-5">Página no disponible</p>
                <p class="text-gray-500 mb-0">Verifique sus permisos...</p>
                <div class="mt-4">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i>Regresar a Dashboard
                    </a>
                </div>
            </div>
        </div>
</x-dashboard-layout>
