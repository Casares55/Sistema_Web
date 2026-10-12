<x-dashboard-layout>
    <div class="container">
        <h1>Registro de Persona</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('registro_biometrico.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h4>Datos de la persona a registrar</h4>
            <div class="row">
                <div class="col-md-4">
                    <label>Tipo de Persona</label>
                    <select name="id_tipopersona" class="form-control" required>
                        <option value="">-- Selecciona tipo --</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id_tipopersona }}" {{ old('id_tipopersona') == $tipo->id_tipopersona ? 'selected' : '' }}>{{ $tipo->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="col-md-4">
                    <label>Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label>Apellido Materno</label>
                    <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
                </div>
                <div class="col-md-4">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                </div>
                <div class="col-md-4">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                </div>
            </div>

            <h4 class="mt-4">Registro Biométrico</h4>
            <div class="row">
                <div class="col-md-6">
                    <label>Etiqueta Registro</label>
                    <input type="text" name="etiqueta_registro" class="form-control" value="{{ old('etiqueta_registro') }}" required>
                </div>
                <div class="col-md-6">
                    <label>Imagen(es)</label>
                    <input type="file" name="imagenes[]" class="form-control" multiple required>
                    <small class="form-text text-muted">Se pueden subir varias imágenes.</small>
                </div>
            </div>

            <button class="btn btn-success mt-4">Registrar</button>
        </form>
    </div>
</x-dashboard-layout>
