<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Detall de jugadora") }}
        </h2>
    </x-slot>


    <x-jugadora :nom="$jugadora->nom" :equip="$jugadora->equip?->nom ?? 'Sense equip'" :data="$jugadora->data_naixement"
        :dorsal="$jugadora->dorsal" :foto="$jugadora->foto" />
</x-app-layout>