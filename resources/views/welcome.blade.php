<x-guest-layout>
  <div class="max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4 text-center text-blue-600">AgendaYa</h1>
    <p class="mb-6 text-center">Reserva tu cita en minutos.</p>
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
          <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('reservas.store') }}" method="POST" class="space-y-4">
      @csrf
      <input type="text" name="nombre" placeholder="Tu nombre" class="w-full border p-2 rounded" required>
      <input type="text" name="telefono" placeholder="Teléfono" class="w-full border p-2 rounded" required>
      <input type="date" name="fecha" id="fecha" class="w-full border p-2 rounded" required>
      <select name="hora" id="hora" class="w-full border p-2 rounded" required></select>
      <textarea name="comentario" placeholder="Comentario (opcional)" class="w-full border p-2 rounded"></textarea>
      <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Reservar</button>
    </form>
  </div>
</x-guest-layout>

<script>
document.getElementById('fecha').addEventListener('change', function() {
    const fecha = this.value;
    fetch(`/horas-disponibles?fecha=${fecha}`)
        .then(res => res.json())
        .then(data => {
            const horaSelect = document.getElementById('hora');
            horaSelect.innerHTML = '';
            if (data.length === 0) {
                horaSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
            } else {
                data.forEach(hora => {
                    const option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    horaSelect.appendChild(option);
                });
            }
        });
});
</script>
