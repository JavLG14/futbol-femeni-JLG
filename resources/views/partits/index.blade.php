<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Calendari de partits") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('Calendari de partits') }}</h1>

                <div class="container">

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border border-gray-300 p-2">{{ __('Jornada') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Fecha') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Local') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Visitant') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Estadi') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Resultat') }}</th>
                                    <th class="border border-gray-300 p-2">{{ __('Accions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partits as $partit)
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="border border-gray-300 p-2">{{ $partit->jornada }}</td>
                                        <td class="border border-gray-300 p-2">{{ $partit->data->format('d/m/Y') }}</td>
                                        <td class="border border-gray-300 p-2">{{ $partit->local->nom }}</td>
                                        <td class="border border-gray-300 p-2">{{ $partit->visitant->nom }}</td>
                                        <td class="border border-gray-300 p-2">
                                            {{ $partit->estadi->nom ?? __('Sense estadi') }}</td>
                                        <td class="border border-gray-300 p-2">
                                            @if($partit->gols_local !== null && $partit->gols_visitant !== null)
                                                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                                            @else
                                                {{ __('Pendiente') }}
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 p-2">
                                            <a href="{{ route('partits.show', $partit) }}"
                                                class="text-blue-700 hover:underline">{{ __('Ver') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>