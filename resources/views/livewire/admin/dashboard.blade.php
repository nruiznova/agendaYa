<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Panel de Administración</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.reservas') }}" class="bg-white border shadow rounded-xl p-6 hover:bg-blue-50 transition">
            <div class="text-blue-600 text-3xl mb-2">📋</div>
            <div class="text-lg font-semibold">Reservas</div>
            <div class="text-gray-500 text-sm">Ver y gestionar todas las reservas</div>
        </a>

        <a href="{{ route('admin.horarios') }}" class="bg-white border shadow rounded-xl p-6 hover:bg-blue-50 transition">
            <div class="text-blue-600 text-3xl mb-2">🕐</div>
            <div class="text-lg font-semibold">Controlar horarios</div>
            <div class="text-gray-500 text-sm">Definir los días y horas disponibles</div>
        </a>

        <a href="{{ route('admin.bloqueos') }}" class="bg-white border shadow rounded-xl p-6 hover:bg-red-50 transition">
            <div class="text-red-600 text-3xl mb-2">🚫</div>
            <div class="text-lg font-semibold">Bloquear fechas/horas</div>
            <div class="text-gray-500 text-sm">Restringir fechas u horas no disponibles</div>
        </a>

    </div>
</div>
