<x-dashboard-layout>
    <div class="container py-4">
        <h2 class="mb-4">Niños registrados</h2>

        <div class="row">
            @forelse($cards as $c)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        @if(!empty($imagenes))
                            <div class="d-flex flex-wrap p-2">
                                @foreach($imagenes as $img)
                                    <img src="file://{{ $img }}" alt="Foto" style="width:60px; height:auto; margin:2px;">
                                @endforeach
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $c->persona->nombre }} {{ $c->persona->apellido_paterno }} {{ $c->persona->apellido_materno }}</h5>

                            <p class="mb-2"><strong>Parentescos:</strong>
                                @if($c->relaciones->isEmpty())
                                    <span class="text-muted">Sin parentescos</span>
                            @else
                                <ul class="mb-0">
                                    @foreach($c->relaciones as $r)
                                        <li>{{ $r->tutor->nombre ?? 'Tutor' }} — {{ $r->parentesco->descripcion ?? 'Parentesco' }} ({{ $r->estado_validacion }})</li>
                                    @endforeach
                                </ul>
                                @endif
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('ninos.pdf', $c->persona->id_persona) }}" class="btn btn-primary btn-block" target="_blank">
                                        Descargar Ficha PDF
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">No hay niños con relaciones personales.</div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>
