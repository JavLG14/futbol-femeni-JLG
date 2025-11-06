<div class="estadi border rounded-lg shadow-md p-4 bg-white">
  <p><strong>Local:</strong> {{ $local }}</p>
  <p><strong>Visitant:</strong> {{ $visitant }}</p>
  <p><strong>Data:</strong> {{ $data }}</p>
  <p><strong>Resultat:</strong> {{ $resultat ?: '-' }}</p>

  <a href="{{ route('partits.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
