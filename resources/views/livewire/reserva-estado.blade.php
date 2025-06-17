<div>
    <select wire:model="estado" class="border rounded px-2 py-1">
        <option value="pendiente">Pendiente</option>
        <option value="confirmada">Confirmada</option>
        <option value="cancelada">Cancelada</option>
    </select>

    <p class="text-xs text-gray-500 mt-1">Estado actual: {{ $estado }}</p>
</div>
