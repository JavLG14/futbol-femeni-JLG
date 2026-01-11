<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Editar Partit") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h1 class="text-3xl font-bold text-blue-800 mb-6">Editar Partit</h1>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-2 mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('partits.update', $partit->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Equip Local</label>
                            <input type="text" value="{{ $partit->local->nom }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                            <input type="hidden" name="local_id" value="{{ $partit->local_id }}">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Equip Visitant</label>
                            <input type="text" value="{{ $partit->visitant->nom }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                            <input type="hidden" name="visitant_id" value="{{ $partit->visitant_id }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="gols_local" class="block font-semibold mb-1">Gols Local</label>
                            <input type="number" name="gols_local" id="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" class="w-full border px-3 py-2 rounded">
                        </div>

                        <div class="mb-4">
                            <label for="gols_visitant" class="block font-semibold mb-1">Gols Visitant</label>
                            <input type="number" name="gols_visitant" id="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" class="w-full border px-3 py-2 rounded">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Estadi</label>
                         <input type="text" value="{{ $partit->estadi->nom ?? 'Sense estadi' }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                         <input type="hidden" name="estadi_id" value="{{ $partit->estadi_id }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Data</label>
                        <input type="date" name="data" value="{{ old('data', $partit->data->format('Y-m-d')) }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Jornada</label>
                        <input type="number" name="jornada" value="{{ old('jornada', $partit->jornada) }}" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar Resultat</button>
                    <a href="{{ route('partits.show', $partit->id) }}" class="ml-4 text-gray-500 hover:underline">Cancel·lar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>