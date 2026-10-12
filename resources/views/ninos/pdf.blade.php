<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha - {{ $nino->nombre }} {{ $nino->apellido_paterno }}</title>
    <style>
        /** --- CONFIGURACIÓN DE PÁGINA (ESTILO INSTITUCIONAL) --- */
        @page {
            margin: 110px 25px 80px 25px; /* Márgenes ajustados para header/footer */
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }

        /** --- HEADER Y FOOTER FIJOS --- */
        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            height: 90px;
            border-bottom: 2px solid #004a87;
        }
        .header-table { width: 100%; border: none; }
        .header-table td { border: none; padding: 0; vertical-align: middle; }

        .school-info h1 {
            margin: 0; font-size: 15px; color: #004a87; text-transform: uppercase;
        }
        .school-info p { margin: 2px 0; font-size: 9px; }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 40px;
            font-size: 9px;
            text-align: center;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        footer table { width: 100%; border: none; }
        footer td { border: none; }
        .pagenum:before { content: counter(page); }

        /** --- MARCA DE AGUA --- */
        body:before {
            content: "";
            position: fixed;
            top: 150px; left: 60px; width: 75%; height: 75%;
            background-image: url("{{ public_path('images/fondo.jpg') }}");
            background-size: contain; background-repeat: no-repeat;
            opacity: 0.08; z-index: -1;
        }

        /** --- TÍTULOS Y SECCIONES --- */
        .section-title {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #f2f2f2;
            padding: 8px;
            border: 1px solid #ccc;
            border-left: 5px solid #004a87; /* Detalle de color institucional */
        }

        .subtitle {
            font-size: 12px;
            color: #004a87;
            border-bottom: 1px solid #ccc;
            margin-top: 25px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            text-transform: uppercase;
        }

        /** --- TARJETA DE PERFIL (DISEÑO GRID CON TABLA) --- */
        .profile-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .profile-container td {
            border: none;
            vertical-align: top;
        }
        /* Columna Foto */
        .col-photo { width: 140px; text-align: center; }
        .foto-frame {
            width: 120px; height: 120px;
            object-fit: cover;
            border-radius: 50%; /* Foto redonda moderna */
            border: 3px solid #004a87;
            padding: 3px;
            background: white;
        }
        .no-foto {
            width: 120px; height: 120px;
            border-radius: 50%;
            border: 2px dashed #ccc;
            display: inline-block;
            line-height: 120px;
            color: #999;
            text-align: center;
        }

        /* Columna Info */
        .col-info { padding-left: 20px; vertical-align: middle !important; }
        .student-name {
            font-size: 18px;
            color: #004a87;
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        .info-row { margin-bottom: 6px; font-size: 11px; }
        .label { font-weight: bold; color: #555; width: 70px; display: inline-block; }

        /** --- TABLA DE DATOS (TUTORES) --- */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #e0e0e0;
            padding: 10px 8px; /* Más padding para aire */
            text-align: left;
            vertical-align: middle;
        }
        .data-table th {
            background-color: #004a87;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border-color: #003865;
        }
        .data-table tr:nth-child(even) { background-color: #f8f9fa; }

        /* Miniatura en tabla */
        .tutor-avatar {
            width: 35px; height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
            vertical-align: middle;
        }

        /* Badges de estado */
        .badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }
        .bg-validado { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .bg-pendiente { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    </style>
</head>
<body>

<!-- HEADER INSTITUCIONAL -->
<header>
    <table class="header-table">
        <tr>
            <td style="width: 15%;">
                <img src="{{ public_path('images/logo_sep.webp') }}" alt="Logo" style="width: 90px; height: auto;">
            </td>
            <td class="school-info" style="text-align: center;">
                <h1>Preescolar General "Maria Elena Montes de Oca"</h1>
                <p><strong>CCT:</strong> 15EJN0293L | <strong>Turno:</strong> Matutino | <strong>Zona:</strong> Urbano</p>
                <p>Calle Porfirio Díaz Centro, Valle de Bravo, Estado de México, CP. 51200</p>
            </td>
            <td style="width: 15%; text-align: right;">
                <img src="{{ public_path('images/escudo_edomex.jpg') }}" alt="Escudo" style="width: 90px; height: auto;">
            </td>
        </tr>
    </table>
</header>

<!-- FOOTER INSTITUCIONAL -->
<footer>
    <table>
        <tr>
            <td style="text-align: left; width: 30%;">
                <div>Generado por:</div>
                <div><strong>{{ Auth::user()->nombre }} {{ Auth::user()->ap }}</strong></div>
                <!-- Verifica si Auth::user()->rol existe antes de imprimir -->
                <div style="font-size: 8px;">{{ Auth::user()->rol->descripcion ?? 'Usuario' }}</div>
            </td>
            <td style="text-align: center; width: 40%;">Página <span class="pagenum"></span></td>
            <td style="text-align: right; width: 30%;">
                Impreso: {{ now()->format('d/m/Y h:i A') }}
            </td>
        </tr>
    </table>
</footer>

<!-- TÍTULO PRINCIPAL -->
<div class="section-title">
    Ficha de Identificación del Estudiante
</div>

<!-- SECCIÓN DE PERFIL (Layout de 2 Columnas) -->
@php
    // Lógica de Foto del Niño
    $fotoBase64 = null;
    // Ojo: Asegúrate de que $nino->id_persona no sea null
    $folder = "C:/py39/Personas/{$nino->id_persona}";
    // Verificamos si la carpeta existe antes del glob para evitar errores
    if(is_dir($folder)){
         $imagenes = glob($folder . '/*.{png,jpg,jpeg}', GLOB_BRACE);
        if (!empty($imagenes)) {
            $tipo = pathinfo($imagenes[0], PATHINFO_EXTENSION);
            $fotoBase64 = 'data:image/' . $tipo . ';base64,' . base64_encode(file_get_contents($imagenes[0]));
        }
    }
@endphp

<table class="profile-container">
    <tr>
        <!-- Columna Izquierda: Foto -->
        <td class="col-photo">
            @if($fotoBase64)
                <img src="{{ $fotoBase64 }}" class="foto-frame" alt="Foto Alumno">
            @else
                <div class="no-foto">Sin Foto</div>
            @endif
        </td>

        <!-- Columna Derecha: Datos -->
        <td class="col-info">
                <span class="student-name">
                    {{ $nino->nombre }} {{ $nino->apellido_paterno }} {{ $nino->apellido_materno }}
                </span>

            <div class="info-row">
                <span class="label">ID Sistema:</span> #{{ $nino->id_persona ?? 'N/A' }}
            </div>
            <div class="info-row">
                <span class="label">Dirección:</span> {{ $nino->direccion ?? 'No registrada' }}
            </div>
            <div class="info-row">
                <span class="label">Correo:</span> {{ $nino->correo ?? 'No registrado' }}
            </div>
            <div class="info-row">
                <!-- Ejemplo de dato extra si lo tienes -->
                <span class="label">Fecha Alta:</span> {{ date('d/m/Y') }}
            </div>
        </td>
    </tr>
</table>

<!-- SECCIÓN DE VÍNCULOS FAMILIARES -->
<div class="subtitle">Vínculos Familiares y Tutores</div>

<table class="data-table">
    <thead>
    <tr>
        <th width="10%">Foto</th>
        <th width="35%">Nombre del Tutor</th>
        <th width="20%">Parentesco</th>
        <th width="15%">Estado</th>
        <th width="20%">Fecha Registro</th>
    </tr>
    </thead>
    <tbody>
    @forelse($relaciones as $r)
        @php
            $fotoTutor = null;
            if (isset($r->tutor)) {
                $folderTutor = "C:/py39/Personas/{$r->tutor->id_persona}";
                if(is_dir($folderTutor)){
                    $imagenesTutor = glob($folderTutor . '/*.{png,jpg,jpeg}', GLOB_BRACE);
                    if (!empty($imagenesTutor)) {
                        $tipo = pathinfo($imagenesTutor[0], PATHINFO_EXTENSION);
                        $fotoTutor = 'data:image/' . $tipo . ';base64,' . base64_encode(file_get_contents($imagenesTutor[0]));
                    }
                }
            }

            // Lógica simple para color de badge
            $estadoClass = ($r->estado_validacion == 'Validado') ? 'bg-validado' : 'bg-pendiente';
        @endphp
        <tr>
            <td style="text-align: center;">
                @if($fotoTutor)
                    <img src="{{ $fotoTutor }}" class="tutor-avatar" alt="Foto">
                @else
                    <span style="color:#ccc; font-size:20px;">•</span>
                @endif
            </td>
            <td>
                <strong>{{ $r->tutor->nombre ?? 'Desconocido' }}</strong><br>
                {{ $r->tutor->apellido_paterno ?? '' }} {{ $r->tutor->apellido_materno ?? '' }}
            </td>
            <td>
                {{ $r->parentesco->descripcion ?? $r->id_parentesco }}
            </td>
            <td>
                    <span class="badge {{ $estadoClass }}">
                        {{ $r->estado_validacion ?? 'Pendiente' }}
                    </span>
            </td>
            <td>
                {{ date('d/m/Y', strtotime($r->fecha_registro)) }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align: center; padding: 20px; color: #777;">
                No existen parentescos registrados para este alumno.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
