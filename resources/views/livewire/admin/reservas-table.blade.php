<div>
    <h2 class="text-xl font-semibold mb-4">Reservas</h2>

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Hora</th>
                <th class="border px-4 py-2">Estado</th>
            </tr> 
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->nombre }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora }}</td>
                    <td>
                        <livewire:reserva-estado 
                        :reservaId="$reserva->id" 
                        :estado="$reserva->estado" 
                        wire:key="reserva-{{ $reserva->id }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
