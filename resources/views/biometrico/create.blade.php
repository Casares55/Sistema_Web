<x-guest-layout>
    <!-- ====== ESTILOS (igual que login) ====== -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900 mb-4">Registro Biométrico</h1>
                            <p class="text-muted">Captura los datos de la persona o sube una imagen.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- FORMULARIO -->
                        <form id="frmRegistro" action="{{ route('biometrico.store') }}" method="POST" enctype="multipart/form-data" class="user">
                            @csrf

                            <div class="form-group">
                                <input name="nombre" class="form-control form-control-user" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <input name="apellido_paterno" class="form-control form-control-user" placeholder="Apellido paterno">
                            </div>
                            <div class="form-group">
                                <input name="apellido_materno" class="form-control form-control-user" placeholder="Apellido materno">
                            </div>
                            <div class="form-group">
                                <input name="telefono" class="form-control form-control-user" placeholder="Teléfono">
                            </div>
                            <div class="form-group">
                                <input name="correo" type="email" class="form-control form-control-user" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                                <label class="small text-gray-700">Subir imagen (opcional)</label>
                                <input type="file" name="imagen" accept="image/*" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registrar Persona
                            </button>
                        </form>

                        <hr>

                        <!-- WEBCAM -->
                        <h4 class="text-center mt-4">Captura con webcam</h4>
                        <div class="text-center">
                            <video id="video" width="320" height="240" autoplay class="border rounded shadow"></video>
                            <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                            <div class="mt-3">
                                <button id="snap" class="btn btn-info btn-sm">Capturar</button>
                            </div>
                        </div>

                        <div class="mt-3">
                            <select id="registro_select" class="form-control">
                                <option value="">Selecciona registro (crea uno primero)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== SCRIPTS ====== -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        // Inicia webcam
        const video = document.getElementById('video');
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => video.srcObject = stream)
            .catch(e => alert('No se pudo acceder a la cámara: ' + e));

        document.getElementById('snap').addEventListener('click', async () => {
            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/png');

            const id_registro = document.getElementById('registro_select').value;
            if (!id_registro) return alert('Selecciona un registro primero.');

            const res = await fetch('{{ route('biometrico.captura') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ image_base64: dataUrl, id_registro })
            });

            const json = await res.json();
            if (json.ok) alert('Imagen enviada y encolada para procesamiento.');
            else alert('Error: ' + (json.error || 'desconocido'));
        });
    </script>

    </body>
</x-guest-layout>
