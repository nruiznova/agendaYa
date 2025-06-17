<x-guest-layout>
  <div class="max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4 text-center text-blue-600">AgendaYa</h1>
    <p class="mb-6 text-center">Reserva tu cita en minutos.</p>
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('reservas.store') }}" method="POST" class="space-y-4">
      @csrf
      <input type="text" name="nombre" placeholder="Tu nombre" class="w-full border p-2 rounded" required>
      <input type="text" name="telefono" placeholder="Teléfono" class="w-full border p-2 rounded" required>
      <input type="date" name="fecha" class="w-full border p-2 rounded" required>
      <input type="time" name="hora" class="w-full border p-2 rounded" required>
      <textarea name="comentario" placeholder="Comentario (opcional)" class="w-full border p-2 rounded"></textarea>
      <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Reservar</button>
    </form>
  </div>
</x-guest-layout>
