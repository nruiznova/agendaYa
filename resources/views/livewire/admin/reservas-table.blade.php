<div>
    <h2 class="text-xl font-semibold mb-4">Reservas</h2>

    @if(session('success'))
        <div class="text-green-600 mb-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Hora</th>
                <th class="border px-4 py-2">Estado</th>
                <th class="border px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td class="border px-4 py-2">{{ $reserva->nombre }}</td>
                    <td class="border px-4 py-2">{{ $reserva->fecha }}</td>
                    <td class="border px-4 py-2">{{ $reserva->hora }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($reserva->estado) }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.reservas.update', $reserva->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="estado" class="border rounded p-1">
                                <option value="pendiente" {{ $reserva->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmada" {{ $reserva->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                <option value="cancelada" {{ $reserva->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded ml-2">Actualizar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
