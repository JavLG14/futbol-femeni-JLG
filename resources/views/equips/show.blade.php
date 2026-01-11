<x-app-layout>
        <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("Detall d'Equip") }}
                </h2>
        </x-slot>


        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                                <div class="flex gap-4 mb-4">
                                    @can('update', $equip)
                                        <a href="{{ route('equips.edit', $equip->id) }}"
                                        class="bg-blue-600 text-white px-3 py-2 rounded">{{ __('Editar equip') }}</a>
                                    @endcan

                                    @can('delete', $equip)
                                        <form action="{{ route('equips.destroy', $equip->id) }}" method="POST"
                                        onsubmit="return confirm('Estàs segur que vols eliminar aquest equip?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                {{ __('Eliminar equip') }}
                                        </button>
                                        </form>
                                    @endcan
                                </div>
                                <x-equip :nom="$equip->nom" :estadi="$equip->estadi->nom ?? 'Sense estadi'" :titols="$equip->titols"
                                        :jugadoras="$equip->jugadores" :edatMitjana="$edatMitjana ?? null"
                                        :ultimsPartits="$ultimsPartits ?? collect([])" :escut="$equip->escut" />
                        </div>
                </div>
        </div>
</x-app-layout>