<div class="equip border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Estadi:</strong> {{ $estadi }}</p>
    <p><strong>Títols:</strong> {{ $titols }}</p>

    <h3 class="text-lg font-semibold mt-6">Jugadores del equip</h3>
    @if($jugadoras->isEmpty())
        <p class="text-gray-600">No hi ha jugadores assignades a aquest equip.</p>
    @else
        <ul class="list-disc list-inside mt-2">
            @foreach($jugadoras as $jugadora)
                <li>
                    <a href="{{ route('jugadores.show', $jugadora->id) }}" class="text-blue-600 hover:underline">
                        {{ $jugadora->nom }} (Dorsal: {{ $jugadora->dorsal }})
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Estadístiques: edat mitjana i últims 5 partits -->
    <div class="mt-6">
        <p class="mt-2"><strong>Edat mitjana de les jugadores:</strong>
            @if(isset($edatMitjana) && $edatMitjana !== null)
                {{ $edatMitjana }} anys
            @else
                No disponible
            @endif
        </p>

        <p class="mt-2"><strong>Últims 5 partits jugats</strong></p>
        @php $parts = $ultimsPartits ?? collect([]); @endphp
        @if($parts->isNotEmpty())
            <table class="w-full border-collapse border border-gray-300 mt-2">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 p-2">Data</th>
                        <th class="border border-gray-300 p-2">Local</th>
                        <th class="border border-gray-300 p-2">Visitant</th>
                        <th class="border border-gray-300 p-2">Estadi</th>
                        <th class="border border-gray-300 p-2">Resultat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parts as $partit)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 p-2">{{ $partit->data?->format('d/m/Y') }}</td>
                            <td class="border border-gray-300 p-2">{{ $partit->local->nom }}</td>
                            <td class="border border-gray-300 p-2">{{ $partit->visitant->nom }}</td>
                            <td class="border border-gray-300 p-2">{{ $partit->estadi->nom }}</td>
                            <td class="border border-gray-300 p-2">
                                @if($partit->gols_local !== null && $partit->gols_visitant !== null)
                                    {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                                @else
                                    Pendiente
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 mt-2">No hi ha partits registrats encara.</p>
        @endif
    </div>

    <a href="{{ route('equips.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Tornar</a>
</div>
