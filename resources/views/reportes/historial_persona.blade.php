<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de {{ $persona->nombre }}</title>
    <style>
        /** Márgenes y fuente base **/
        @page {
            margin: 100px 25px 80px 25px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
        }

        /** Header **/
        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 80px;
            border-bottom: 2px solid #004a87;
        }
        .header-table {
            width: 100%;
            border: none;
        }
        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }
        .school-info h1 {
            margin: 0;
            font-size: 16px;
            color: #004a87;
            text-transform: uppercase;
        }
        .school-info p {
            margin: 2px 0;
            font-size: 10px;
        }

        /** Footer **/
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
        footer table {
            width: 100%;
            border: none;
        }
        footer td {
            border: none;
        }

        /** Título del reporte **/
        .report-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #f2f2f2;
            padding: 8px;
            border: 1px solid #ccc;
        }

        /** Tabla de datos **/
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #004a87;
            color: white;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /** Estado visual **/
        .status-ok { color: green; }
        .status-denied { color: red; }

        .pagenum:before {
            content: counter(page);
        }

        /** Marca de agua **/
        body:before {
            content: "";
            position: fixed;
            top: 150px;
            left: 60px;
            width: 75%;
            height: 75%;
            background-image: url("{{ public_path('images/fondo.jpg') }}");
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.10;
            z-index: -1;
        }
    </style>
</head>
<body>

<header>
    <table class="header-table">
        <tr>
            <td style="width: 15%;">
                <img src="{{ public_path('images/logo_sep.webp') }}" alt="Logo" style="width: 110px; height: auto;">
            </td>
            <td class="school-info" style="text-align: center;">
                <h1>Preescolar General "Maria Elena Montes de Oca"</h1>
                <p><strong>CCT:</strong> 15EJN0293L | <strong>Turno:</strong> Matutino | <strong>Zona:</strong> Urbano</p>
                <p>Calle Porfirio Díaz Centro, Valle de Bravo, Estado de México, CP. 51200</p>
            </td>
            <td style="width: 15%; text-align: right;">
                <img src="{{ public_path('images/escudo_edomex.jpg') }}" alt="Escudo" style="width: 110px; height: auto;">
            </td>
        </tr>
    </table>
</header>

<footer>
    <table>
        <tr>
            <td style="text-align: left; width: 30%;">
                <div>Generado por:</div>
                <div><strong>{{ Auth::user()->nombre }} {{ Auth::user()->ap }} {{ Auth::user()->am }}</strong></div>
                <div style="font-size: 9px; color: #555;">Cargo: {{ Auth::user()->rol->descripcion }}</div>
            </td>
            <td style="text-align: center; width: 40%;">Página <span class="pagenum"></span></td>
            <td style="text-align: right; width: 30%;">Fecha de impresión: {{ now()->format('h:i A') }}</td>
        </tr>
    </table>
</footer>

<div class="report-title">
    Historial de: {{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}
</div>

<table class="data-table">
    <thead>
    <tr>
        <th>Evento</th>
        <th>Dispositivo</th>
        <th>Confianza</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($eventos as $e)
        <tr>
            <td>{{ $e->resultado }}</td>
            <td>{{ $e->dispositivo->descripcion ?? 'N/A' }}</td>
            <td>{{ $e->confianza }}%</td>
            <td>{{ date('d/m/y', strtotime($e->fecha_evento)) }}</td>
            <td><small style="color: #666;">{{ date('g:i A', strtotime($e->fecha_evento)) }}</small></td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
