<x-dashboard-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Control de Accesos (Entradas y Salidas)</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200 text-sm text-gray-800">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Persona</th>
                    <th class="px-4 py-2 border">Dispositivo</th>
                    <th class="px-4 py-2 border">Tipo de Evento</th>
                    <th class="px-4 py-2 border">Confianza</th>
                    <th class="px-4 py-2 border">Resultado</th>
                    <th class="px-4 py-2 border">Fecha</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($eventos as $evento)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration + ($eventos->currentPage() - 1) * $eventos->perPage() }}</td>
                        <td class="px-4 py-2 border">
                            @if($evento->persona)
                                {{ $evento->persona->nombre }} {{ $evento->persona->apellido_paterno }}
                            @else
                                <span class="text-gray-400 italic">Desconocido</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">{{ $evento->dispositivo->descripcion ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border text-center">
                            @php
                                $color = match($evento->tipoEvento->descripcion) {
                                    'Entrada' => 'bg-green-100 text-green-800',
                                    'Salida' => 'bg-blue-100 text-blue-800',
                                    'Acceso denegado' => 'bg-red-100 text-red-800',
                                    'Acceso permitido' => 'bg-emerald-100 text-emerald-800',
                                    default => 'bg-gray-100 text-gray-700'
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">
                                    {{ $evento->tipoEvento->descripcion }}
                                </span>
                        </td>
                        <td class="px-4 py-2 border text-center">
                            {{ $evento->confianza ? number_format($evento->confianza, 2) . '%' : '—' }}
                        </td>
                        <td class="px-4 py-2 border text-center">{{ $evento->resultado }}</td>
                        <td class="px-4 py-2 border text-center">{{ $evento->fecha_evento }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No hay eventos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $eventos->links() }}
        </div>
    </div>
</x-dashboard-layout>
