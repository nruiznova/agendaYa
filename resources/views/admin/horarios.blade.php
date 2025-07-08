<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Horarios Disponibles
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulario para crear horario --}}
            <form action="{{ route('admin.horarios.store') }}" method="POST" class="space-y-4 mb-8">
                @csrf
                <div>
                    <label class="block font-medium">Día:</label>
                    <select name="dia" class="w-full border rounded p-2">
                        <option value="">-- Selecciona un día --</option>
                        @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                            <option value="{{ $dia }}" {{ old('dia') == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                        @endforeach
                    </select>
                    @error('dia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Hora inicio:</label>
                        <input type="time" name="hora_inicio" class="w-full border rounded p-2" value="{{ old('hora_inicio') }}">
                        @error('hora_inicio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium">Hora fin:</label>
                        <input type="time" name="hora_fin" class="w-full border rounded p-2" value="{{ old('hora_fin') }}">
                        @error('hora_fin') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Intervalo (minutos):</label>
                    <input type="number" name="intervalo" min="5" max="120" class="w-full border rounded p-2" value="{{ old('intervalo', 30) }}">
                    @error('intervalo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar horario</button>
            </form>

            {{-- Tabla de horarios existentes --}}
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Día</th>
                        <th class="border px-2 py-1">Inicio</th>
                        <th class="border px-2 py-1">Fin</th>
                        <th class="border px-2 py-1">Intervalo</th>
                        <th class="border px-2 py-1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horarios as $horario)
                        <tr>
                            <td class="border px-2 py-1">{{ $horario->dia }}</td>
                            <td class="border px-2 py-1">{{ $horario->hora_inicio }}</td>
                            <td class="border px-2 py-1">{{ $horario->hora_fin }}</td>
                            <td class="border px-2 py-1">{{ $horario->intervalo }} min</td>
                            <td class="border px-2 py-1">
                                <form action="{{ route('admin.horarios.destroy', $horario->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este horario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No hay horarios configurados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
