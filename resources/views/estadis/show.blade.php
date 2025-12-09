<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Detall d'Estadi") }}
        </h2>
    </x-slot>


    <x-estadi :nom="$estadi->nom" :capacitat="$estadi->capacitat" :equips="$estadi->Equips" />
</x-app-layout>