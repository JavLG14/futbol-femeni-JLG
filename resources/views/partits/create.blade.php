<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Crear Partido") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="container">
                    <h1 class="text-2xl font-bold mb-6">Crear Partido</h1>

                    <form action="{{ route('partits.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                        @csrf

                        <!-- Local -->
                        <div class="mb-4">
                            <label for="local_id" class="block font-semibold mb-1">Equipo Local:</label>
                            <select name="local_id" id="local_id"
                                class="w-full border rounded p-2 @error('local_id') border-red-500 @enderror">
                                <option value="">Selecciona un equipo</option>
                                @foreach($equips as $equip)
                                    <option value="{{ $equip->id }}" {{ old('local_id') == $equip->id ? 'selected' : '' }}>
                                        {{ $equip->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('local_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Visitante -->
                        <div class="mb-4">
                            <label for="visitant_id" class="block font-semibold mb-1">Equipo Visitante:</label>
                            <select name="visitant_id" id="visitant_id"
                                class="w-full border rounded p-2 @error('visitant_id') border-red-500 @enderror">
                                <option value="">Selecciona un equipo</option>
                                @foreach($equips as $equip)
                                    <option value="{{ $equip->id }}" {{ old('visitant_id') == $equip->id ? 'selected' : '' }}>
                                        {{ $equip->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('visitant_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="data" class="block font-semibold mb-1">Fecha:</label>
                            <input type="date" name="data" id="data" value="{{ old('data') }}"
                                class="w-full border rounded p-2 @error('data') border-red-500 @enderror">
                            @error('data') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Jornada -->
                        <div class="mb-4">
                            <label for="jornada" class="block font-semibold mb-1">Jornada:</label>
                            <input type="number" name="jornada" id="jornada" value="{{ old('jornada') }}"
                                class="w-full border rounded p-2 @error('jornada') border-red-500 @enderror">
                            @error('jornada') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Estadio -->
                        <div class="mb-4">
                            <label for="estadi_id" class="block font-semibold mb-1">Estadio:</label>
                            <select name="estadi_id" id="estadi_id"
                                class="w-full border rounded p-2 @error('estadi_id') border-red-500 @enderror">
                                <option value="">Selecciona un estadio</option>
                                @foreach($estadis as $estadi)
                                    <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                                        {{ $estadi->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estadi_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear
                            Partido</button>
                        <a href="{{ route('partits.index') }}" class="ml-4 text-blue-600 hover:underline">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>