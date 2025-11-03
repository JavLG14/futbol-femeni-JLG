<div class="estadi border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
  <p><strong>Localitat:</strong> {{ $localitat }}</p>
  <p><strong>Aforament:</strong> {{ $aforament }}</p>
  <p><strong>Equip:</strong> {{ $equip }}</p>

  <a href="{{ route('estadis.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
