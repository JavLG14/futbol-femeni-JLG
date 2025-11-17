<div class="equip border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
  <p><strong>Estadi:</strong> {{ $estadi }}</p>
  <p><strong>Títols:</strong> {{ $titols }}</p>
  <a href="{{ route('equips.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>