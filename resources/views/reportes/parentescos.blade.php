<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #444; padding: 5px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Reporte de Tutores y Niños</h2>
<p>Generado: {{ now() }}</p>

<table>
    <thead>
    <tr>
        <th>Tutor</th>
        <th>Niño</th>
        <th>Parentesco</th>
        <th>Estado</th>
        <th>Fecha Validación</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($relaciones as $r)
        <tr>
            <td>{{ $r->tutor->nombre }} {{ $r->tutor->apellido_paterno }}</td>
            <td>{{ $r->nino->nombre }} {{ $r->nino->apellido_paterno }}</td>
            <td>{{ $r->parentesco->descripcion }}</td>
            <td>{{ $r->estado_validacion }}</td>
            <td>{{ $r->fecha_validacion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
