<x-dashboard-layout>
    <div class="container py-4">
        <h2>Solicitar relación</h2>

        <form action="{{ route('relaciones.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Tutor</label>
                <select name="id_tutor" class="form-control" required>
                    <option value="">-- Selecciona --</option>
                    @foreach($personas as $p)
                        <option value="{{ $p->id_persona }}">{{ $p->nombre }} {{ $p->apellido_paterno }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Niño</label>
                <select name="id_nino" class="form-control" required>
                    <option value="">-- Selecciona --</option>
                    @foreach($personas as $p)
                        <option value="{{ $p->id_persona }}">{{ $p->nombre }} {{ $p->apellido_paterno }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Parentesco</label>
                <select name="id_parentesco" class="form-control" required>
                    <option value="">-- Selecciona --</option>
                    @foreach($parentescos as $pa)
                        <option value="{{ $pa->id_parentesco }}">{{ $pa->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Observaciones</label>
                <textarea name="observaciones" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Enviar solicitud</button>
        </form>
    </div>
</x-dashboard-layout>
