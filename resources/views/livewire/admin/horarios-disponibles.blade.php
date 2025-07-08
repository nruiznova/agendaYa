<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Horarios Disponibles</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-3 mb-6">
        <div>
            <label>Día:</label>
            <select wire:model.defer="dia" class="w-full border p-2 rounded">
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                    <option value="{{ $dia }}">{{ $dia }}</option>
                @endforeach
            </select>
            @error('dia') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label>Hora inicio:</label>
                <input type="time" wire:model.defer="hora_inicio" class="w-full border p-2 rounded">
                @error('hora_inicio') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="flex-1">
                <label>Hora fin:</label>
                <input type="time" wire:model.defer="hora_fin" class="w-full border p-2 rounded">
                @error('hora_fin') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label>Intervalo (minutos):</label>
            <input type="number" wire:model.defer="intervalo" class="w-full border p-2 rounded" min="5" max="120">
            @error('intervalo') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>

    <table class="w-full table-auto border-collapse border">
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
            @foreach($horarios as $horario)
                <tr>
                    <td class="border px-2 py-1">{{ $horario->dia }}</td>
                    <td class="border px-2 py-1">{{ $horario->hora_inicio }}</td>
                    <td class="border px-2 py-1">{{ $horario->hora_fin }}</td>
                    <td class="border px-2 py-1">{{ $horario->intervalo }} min</td>
                    <td class="border px-2 py-1">
                        <button wire:click="delete({{ $horario->id }})" class="text-red-600 hover:underline">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
