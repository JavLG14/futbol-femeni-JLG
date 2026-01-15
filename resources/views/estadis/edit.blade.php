<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Modificació d'Estadi") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-2 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('estadis.update', $estadi->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nom" class="block font-bold">{{ __('Nom')}}:</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $estadi->nom) }}"
                            class="border p-2 w-full">
                    </div>

                    <div>
                        <label for="ciutat" class="block font-bold">{{ __('Ciutat')}}:</label>
                        <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}"
                            class="border p-2 w-full">
                    </div>

                    <div>
                        <label for="capacitat" class="block font-bold">{{__('Capacitat')}}:</label>
                        <input type="number" name="capacitat" id="capacitat"
                            value="{{ old('capacitat', $estadi->capacitat) }}" class="border p-2 w-full">
                    </div>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded">{{__('Actualitzar')}}</button>
                    <a href="{{ route('estadis.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded ml-2">{{__('Cancel·lar')}}</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>