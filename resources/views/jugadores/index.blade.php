<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Llista de jugadores") }}
        </h2>
    </x-slot>


    <h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de jugadores</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
    @endif

    <p class="mb-4">
        <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Afegir jugadora</a>
    </p>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 p-2">Nom</th>
                <th class="border border-gray-300 p-2">Equip</th>
                <th class="border border-gray-300 p-2">Dorsal</th>
                <th class="border border-gray-300 p-2">Data Naixement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jugadores as $jugadora)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 p-2">
                        <a href="{{ route('jugadores.show', $jugadora->id) }}"
                            class="text-blue-700 hover:underline">{{ $jugadora->nom }}</a>
                    </td>
                    <td class="border border-gray-300 p-2">{{ $jugadora->equip?->nom ?? 'Sense equip' }}</td>
                    <td class="border border-gray-300 p-2">{{ $jugadora->dorsal }}</td>
                    <td class="border border-gray-300 p-2">{{ $jugadora->data_naixement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>