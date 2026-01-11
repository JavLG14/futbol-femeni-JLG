<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Detall de jugadora") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex gap-4 mb-4">
                    @can('update', $jugadora)
                        <a href="{{ route('jugadores.edit', $jugadora->id) }}"
                            class="bg-blue-600 text-white px-3 py-2 rounded">{{ __('Editar jugadora') }}</a>
                    @endcan

                    @can('delete', $jugadora)
                        <form action="{{ route('jugadores.destroy', $jugadora->id) }}" method="POST"
                            onsubmit="return confirm('Estàs segur que vols eliminar aquesta jugadora?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                {{ __('Eliminar jugadora') }}
                            </button>
                        </form>
                    @endcan
                </div>

                <x-jugadora :nom="$jugadora->nom" :equip="$jugadora->equip?->nom ?? 'Sense equip'"
                    :data="$jugadora->data_naixement" :dorsal="$jugadora->dorsal" :foto="$jugadora->foto" />
            </div>
        </div>
    </div>
</x-app-layout>