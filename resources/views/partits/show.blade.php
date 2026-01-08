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
                        <h1 class="text-2xl font-bold mb-4">Partido Jornada {{ $partit->jornada }}</h1>

                        <p><strong>Fecha:</strong> {{ $partit->data->format('d/m/Y') }}</p>
                        <p><strong>Local:</strong> {{ $partit->local->nom }}</p>
                        <p><strong>Visitante:</strong> {{ $partit->visitant->nom }}</p>
                        <p><strong>Estadio:</strong> {{ $partit->estadi->nom }}</p>
                        <p><strong>Resultado:</strong>
                            @if($partit->gols_local !== null && $partit->gols_visitant !== null)
                                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                            @else
                                Pendiente
                            @endif
                        </p>

                        <a href="{{ route('partits.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">←
                            Volver al
                            calendario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>