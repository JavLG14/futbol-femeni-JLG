<x-app-layout>
        <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("Detall d'Equip") }}
                </h2>
        </x-slot>


        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                                <p class="mb-4">
                                        <a href="{{ route('equips.edit', $equip->id) }}"
                                                class="bg-blue-600 text-white px-3 py-2 rounded">Editar
                                                equip</a>
                                </p>
                                <x-equip :nom="$equip->nom" :estadi="$equip->estadi->nom" :titols="$equip->titols"
                                        :jugadoras="$equip->jugadores" :edatMitjana="$edatMitjana ?? null"
                                        :ultimsPartits="$ultimsPartits ?? collect([])" :escut="$equip->escut" />
                        </div>
                </div>
        </div>
</x-app-layout>