<x-dashboard-layout>

    <style>
        .face-container {
            display: flex;
            gap: 40px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .camera-box, .result-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            width: 450px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 3px solid #6C63FF;
        }

        .camera-title {
            font-size: 22px;
            font-weight: bold;
            color: #6C63FF;
            text-align: center;
            margin-bottom: 10px;
        }

        #video {
            border-radius: 15px;
            width: 100%;
            border: 4px solid #6C63FF;
        }

        #capturaImg {
            width: 100%;
            border-radius: 15px;
            border: 4px solid #FF6584;
        }

        .btn-capturar {
            background: #6C63FF;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            width: 280px;
            margin: 25px auto 0;
            display: block;
            transition: 0.2s ease-in-out;
        }

        .btn-capturar:hover {
            background: #4f47d6;
            transform: scale(1.03);
        }

        .selector-box {
            background: white;
            border-radius: 12px;
            padding: 15px 20px;
            margin: 10px auto 30px;
            width: 60%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .info-card {
            margin-top: 40px;
            margin-left: auto;
            margin-right: auto;
            padding: 25px;
            width: 450px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 3px solid #6C63FF;
            text-align: center;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);}
            to { opacity: 1; transform: translateY(0);}
        }

        .info-card img {
            width: 140px;
            height: 140px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #6C63FF;
        }

        .info-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .info-sub {
            color: #666;
            margin-top: 10px;
            font-size: 18px;
        }

        .info-success { color: #28a745; font-weight: bold; }
        .info-error { color: #dc3545; font-weight: bold; }

    </style>

    <div class="container">

        <h1 class="text-center mt-3" style="font-size:32px; font-weight:bold; color:#6C63FF;">
            Reconocimiento Facial en Tiempo Real
        </h1>

        <!-- Selector de dispositivo -->
        <div class="selector-box">
            <label for="dispositivo">Selecciona un dispositivo:</label>
            <select id="dispositivo" class="form-control mt-2">
                <option value="">-- Selecciona cámara --</option>
                @foreach($dispositivos as $d)
                    <option value="{{ $d->id_dispositivo }}">{{ $d->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="face-container">

            <!-- Cámara -->
            <div class="camera-box">
                <div class="camera-title">Vista de Cámara</div>
                <video id="video" width="400" height="300" autoplay playsinline></video>
            </div>

            <!-- Resultado -->
            <div class="result-box">
                <div class="camera-title" style="color:#FF6584">Imagen Capturada</div>
                <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
                <img id="capturaImg" style="display:none;">
            </div>

        </div>

        <!-- Botón -->
        <button id="capturarBtn" class="btn-capturar">
            📸 Capturar y Procesar
        </button>

        <!-- Tarjeta Informativa -->
        <div class="info-card" id="infoCard">
            <img id="infoFoto" src="">
            <div class="info-title" id="infoNombre">---</div>
            <div class="info-sub">Confianza: <span id="infoConfianza"></span>%</div>
            <div class="info-sub" id="infoResultado"></div>
        </div>

    </div>

    @section('scripts')
        <script>
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const capturaImg = document.getElementById('capturaImg');
            const btn = document.getElementById('capturarBtn');

            const infoCard = document.getElementById('infoCard');
            const infoFoto = document.getElementById('infoFoto');
            const infoNombre = document.getElementById('infoNombre');
            const infoConfianza = document.getElementById('infoConfianza');
            const infoResultado = document.getElementById('infoResultado');

            // Activar cámara
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => video.srcObject = stream)
                .catch(err => alert("No se pudo acceder a la cámara."));

            // Capturar y enviar
            btn.addEventListener('click', async () => {

                const dispositivoId = document.getElementById('dispositivo').value;
                if (!dispositivoId) {
                    alert('Selecciona un dispositivo');
                    return;
                }

                // Capturar imagen
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                const dataURL = canvas.toDataURL('image/jpeg');
                capturaImg.src = dataURL;
                capturaImg.style.display = 'block';

                // Convertir el base64 A ARCHIVO REAL
                const blob = await (await fetch(dataURL)).blob();

                // Construir FormData para enviar
                const formData = new FormData();
                formData.append("imagen", blob, "captura.jpg");
                formData.append("id_dispositivo", dispositivoId);

                // ENVIAR al backend Laravel
                fetch("{{ route('reconocimiento.procesar') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {

                        console.log("RESPUESTA:", data);

                        infoCard.style.display = "block";
                        infoFoto.src = capturaImg.src;

                        // Nombre
                        if (data.persona) {
                            infoNombre.textContent =
                                `${data.persona.nombre} ${data.persona.apellido_paterno} ${data.persona.apellido_materno}`;
                        } else {
                            infoNombre.textContent = "NO RECONOCIDO";
                        }

                        // Confianza (0–1 → *100)
                        infoConfianza.textContent = data.confianza.toFixed(2);

                        // Resultado
                        if (data.resultado === "Acceso permitido") {
                            infoResultado.innerHTML = "<span class='info-success'>✔ Acceso Permitido</span>";
                        } else {
                            infoResultado.innerHTML = "<span class='info-error'>✖ Acceso Denegado</span>";
                        }

                    })
                    .catch(err => {
                        console.error(err);
                        alert("Error al procesar imagen.");
                    });
            });
        </script>
    @endsection
</x-dashboard-layout>
