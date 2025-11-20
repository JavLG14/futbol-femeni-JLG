@extends('layouts.app')
@section('title', "Calendari de Partits")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Calendari de partits</h1>

<div class="container">    

    <p class="mb-4">
        <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Afegir partit</a>
    </p>

        <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">Jornada</th>
                            <th class="border border-gray-300 p-2">Fecha</th>
                            <th class="border border-gray-300 p-2">Local</th>
                            <th class="border border-gray-300 p-2">Visitant</th>
                            <th class="border border-gray-300 p-2">Estadi</th>
                            <th class="border border-gray-300 p-2">Resultat</th>
                            <th class="border border-gray-300 p-2">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partits as $partit)
                            <tr class="hover:bg-gray-100 text-center">
                                <td class="border border-gray-300 p-2">{{ $partit->jornada }}</td>
                                <td class="border border-gray-300 p-2">{{ $partit->data->format('d/m/Y') }}</td>
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
                                <td class="border border-gray-300 p-2">
                                    <a href="{{ route('partits.show', $partit) }}" class="text-blue-700 hover:underline">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
</div>
@endsection
