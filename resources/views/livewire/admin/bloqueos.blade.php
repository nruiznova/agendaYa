<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Fechas y Horas Bloqueadas</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded"> 
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-3 mb-6">
        <div>
            <label>Fecha:</label>
            <input type="date" wire:model="fecha" class="w-full border p-2 rounded">
            @error('fecha') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Hora (opcional):</label>
            <input type="time" wire:model="hora" class="w-full border p-2 rounded">
            @error('hora') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Motivo (opcional):</label>
            <input type="text" wire:model="motivo" class="w-full border p-2 rounded">
            @error('motivo') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>

    <table class="w-full table-auto border-collapse border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">Fecha</th>
                <th class="border px-2 py-1">Hora</th>
                <th class="border px-2 py-1">Motivo</th>
                <th class="border px-2 py-1">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bloqueos as $bloqueo)
                <tr>
                    <td class="border px-2 py-1">{{ $bloqueo->fecha }}</td>
                    <td class="border px-2 py-1">{{ $bloqueo->hora ?? 'Todo el día' }}</td>
                    <td class="border px-2 py-1">{{ $bloqueo->motivo }}</td>
                    <td class="border px-2 py-1">
                        <button wire:click="delete({{ $bloqueo->id }})" class="text-red-600 hover:underline">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
