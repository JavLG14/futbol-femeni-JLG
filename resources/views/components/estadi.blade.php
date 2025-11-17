<div class="estadi border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Aforament:</strong> {{ $capacitat }}</p>
    <p><strong>Equips:</strong>
        @if($equips && count($equips) > 0)
            {{ $equips->pluck('nom')->join(', ') }}
        @else
            <span class="text-gray-500">Sense equips</span>
        @endif
    </p>

    <a href="{{ route('estadis.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
