<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Editar jugadora") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h1 class="text-3xl font-bold text-blue-800 mb-6">Editar jugadora</h1>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-2 mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jugadores.update', $jugadora->id) }}" method="POST"
                    enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nom" class="block font-semibold mb-1">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="equip_id" class="block font-semibold mb-1">Equip</label>
                        <select name="equip_id" id="equip_id" class="w-full border px-3 py-2 rounded" required>
                            <option value="">Selecciona un equip</option>
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}" {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
                                    {{ $equip->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="data_naixement" class="block font-semibold mb-1">Data Naixement</label>
                        <input type="date" name="data_naixement" id="data_naixement"
                            value="{{ old('data_naixement', $jugadora->data_naixement) }}"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="dorsal" class="block font-semibold mb-1">Dorsal</label>
                        <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}"
                            min="0" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="block font-semibold mb-1">Foto (.png, opcional)</label>
                        @if ($jugadora->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $jugadora->foto) }}" alt="Foto actual" class="h-24 rounded">
                            </div>
                        @endif
                        <input type="file" name="foto" id="foto" accept=".png" class="w-full border px-3 py-2 rounded">
                        <p class="text-sm text-gray-500 mt-1">Deixa-ho en blanc per mantenir la foto actual.</p>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
                    <a href="{{ route('jugadores.show', $jugadora->id) }}"
                        class="ml-4 text-gray-500 hover:underline">Cancel·lar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>