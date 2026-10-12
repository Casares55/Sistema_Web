<x-dashboard-layout>
    <div class="container">

        <h2 class="text-center mb-4">📈 Estadísticas del Sistema</h2>

        <div class="card shadow-sm p-4">
            <canvas id="graficaEventos"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('graficaEventos');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($tipos->keys()) !!},
                datasets: [{
                    label: 'Cantidad de eventos',
                    data: {!! json_encode($tipos->values()) !!},
                }]
            }
        });
    </script>
</x-dashboard-layout>
