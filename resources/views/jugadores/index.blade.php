<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Llista de jugadores") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('Llistat de jugadores') }}</h1>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
                @endif

                @can('create', App\Models\Jugadora::class)
                    <p class="mb-4">
                        <a href="{{ route('jugadores.create') }}"
                            class="bg-blue-600 text-white px-3 py-2 rounded">{{ __('Afegir jugadora') }}</a>
                    </p>
                @endcan

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">{{ __('Nom') }}</th>
                            <th class="border border-gray-300 p-2">{{ __('Equip') }}</th>
                            <th class="border border-gray-300 p-2">{{ __('Dorsal') }}</th>
                            <th class="border border-gray-300 p-2">{{ __('Data Naixement') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadores as $jugadora)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 p-2">
                                    <a href="{{ route('jugadores.show', $jugadora->id) }}"
                                        class="text-blue-700 hover:underline">{{ $jugadora->nom }}</a>
                                </td>
                                <td class="border border-gray-300 p-2">{{ $jugadora->equip?->nom ?? __('Sense equip') }}
                                </td>
                                <td class="border border-gray-300 p-2">{{ $jugadora->dorsal }}</td>
                                <td class="border border-gray-300 p-2">{{ $jugadora->data_naixement }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $jugadores->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>