<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Detalle del Partido") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="container">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h1 class="text-2xl font-bold mb-4">{{ __('Partido Jornada') }} {{ $partit->jornada }}</h1>

                        <p><strong>{{ __('Fecha') }}:</strong> {{ $partit->data->format('d/m/Y') }}</p>
                        <p><strong>{{ __('Local') }}:</strong> {{ $partit->local->nom }}</p>
                        <p><strong>{{ __('Visitante') }}:</strong> {{ $partit->visitant->nom }}</p>
                        <p><strong>{{ __('Estadio') }}:</strong> {{ $partit->estadi->nom ?? __('Sense estadi') }}</p>
                        <p><strong>{{ __('Resultado') }}:</strong>
                            @if($partit->gols_local !== null && $partit->gols_visitant !== null)
                                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                            @else
                                {{ __('Pendiente') }}
                            @endif
                        </p>

                        @can('update', $partit)
                            <div class="mt-4">
                                <a href="{{ route('partits.edit', $partit->id) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    {{ __('Editar Partit') }}
                                </a>
                            </div>
                        @endcan

                        <a href="{{ route('partits.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">←
                            {{ __('Volver al calendario') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>