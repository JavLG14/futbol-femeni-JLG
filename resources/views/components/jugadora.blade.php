<div class="jugadora border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Equip:</strong> {{ $equip }}</p>
    <p><strong>Data Naixement:</strong> {{ $data }}</p>
    <p><strong>Dorsal:</strong> {{ $dorsal }}</p>

    @if($foto)
        <div class="mt-3">
            <img src="{{ $foto }}" alt="Foto de {{ $nom }}" class="img-fluid" style="max-width: 200px;">
        </div>
    @endif

    <a href="{{ route('jugadores.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
