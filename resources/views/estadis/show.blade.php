<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Detall d'Estadi") }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(auth()->check() && auth()->user()->role === 'administrador')
                    <div class="mb-4 text-left">
                        <form action="{{ route('estadis.destroy', $estadi->id) }}" method="POST"
                            onsubmit="return confirm('Estàs segur que vols eliminar aquest estadi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                {{ __('Eliminar estadi') }}
                            </button>
                        </form>
                    </div>
                @endif

                <x-estadi :nom="$estadi->nom" :capacitat="$estadi->capacitat" :equips="$estadi->Equips" />
            </div>
        </div>
    </div>
</x-app-layout>