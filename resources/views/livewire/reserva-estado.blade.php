<div>
    <select wire:model="estado" class="border px-2 py-1 rounded">
        <option value="pendiente">Pendiente</option>
        <option value="confirmada">Confirmada</option>
        <option value="cancelada">Cancelada</option>
    </select>

    @if (session()->has('success'))
        <div class="text-green-600 text-sm mt-1">
            {{ session('success') }}
        </div>
    @endif
</div>
