<div class="estadi border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
  <p><strong>Equip:</strong> {{ $equip }}</p>
  <p><strong>Posició:</strong> {{ $posicio }}</p>

  <a href="{{ route('jugadores.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
