<x-dashboard-layout>
    <div class="container">

        <h2 class="mb-4 text-center">📊 Módulo de Reportes</h2>

        <div class="row justify-content-center">

            <!-- Reporte de Eventos -->
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h4>Control de Accesos</h4>
                        <p class="text-muted">Entradas, salidas, accesos permitidos y denegados.</p>
                        <a href="{{ route('reportes.eventos') }}"
                           class="btn btn-primary btn-lg w-100 mt-2" target="_blank">
                            📄 Descargar Reporte de Eventos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reporte de Parentescos -->
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h4>Relaciones Familiares</h4>
                        <p class="text-muted">Tutores, niños y parentescos validados.</p>
                        <a href="{{ route('ninos.index') }}"
                           class="btn btn-success btn-lg w-100 mt-2" target="_blank">
                            👨‍👩‍👦 Descargar Reporte de Parentescos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reporte Dashboard -->
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h4>Dashboard Estadístico</h4>
                        <p class="text-muted">Gráficas de accesos y actividad del sistema.</p>
                        <a href="{{ route('reportes.dashboard') }}"
                           class="btn btn-info btn-lg w-100 mt-2">
                            📊 Ver Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reporte por Persona con Buscador -->
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center">Historial por Persona</h4>
                        <p class="text-muted text-center">
                            Escribe el nombre de la persona que deseas consultar.
                        </p>

                        <div class="row justify-content-center">

                            <!-- Buscador -->
                            <div class="col-md-6">
                                <input type="text" id="buscarPersona"
                                       class="form-control"
                                       placeholder="Buscar persona..." autocomplete="off">

                                <!-- Lista de autocompletado -->
                                <ul id="resultadosBusqueda"
                                    class="list-group mt-2"
                                    style="display:none; max-height:200px; overflow-y:auto;">
                                </ul>
                            </div>

                            <!-- Botón -->
                            <div class="col-md-3">
                                <button onclick="generarHistorial()"
                                        class="btn btn-warning btn-lg w-100 mt-2">
                                    👤 Generar Historial
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
        let personaSeleccionada = null;

        // Buscador en tiempo real
        document.getElementById('buscarPersona').addEventListener('input', function () {
            let texto = this.value;

            if (texto.length < 2) {
                document.getElementById('resultadosBusqueda').style.display = 'none';
                return;
            }

            fetch("{{ route('reportes.buscarPersona') }}?q=" + texto)
                .then(res => res.json())
                .then(data => {
                    let lista = document.getElementById('resultadosBusqueda');
                    lista.innerHTML = "";

                    if (data.length === 0) {
                        lista.style.display = 'none';
                        return;
                    }

                    data.forEach(p => {
                        let item = document.createElement('li');
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.textContent = p.nombre + " " + p.apellido_paterno + " " + p.apellido_materno;

                        item.onclick = () => {
                            personaSeleccionada = p.id_persona;
                            document.getElementById('buscarPersona').value = item.textContent;
                            lista.style.display = 'none';
                        };

                        lista.appendChild(item);
                    });

                    lista.style.display = 'block';
                });
        });

        // Generar PDF según persona seleccionada
        function generarHistorial() {
            if (!personaSeleccionada) {
                alert("Selecciona una persona de la lista.");
                return;
            }

            window.open("{{ url('/reportes/persona') }}/" + personaSeleccionada, "_blank");
        }
    </script>
</x-dashboard-layout>

