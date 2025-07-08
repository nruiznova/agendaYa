<div>
    <select wire:model="estado" class="border rounded p-1">
        <option value="pendiente">Pendiente</option>
        <option value="confirmada">Confirmada</option>
        <option value="cancelada">Cancelada</option>
    </select>

    @if (session()->has('success'))
        <span class="text-green-600 text-sm ml-2">{{ session('success') }}</span>
    @endif
</div>
