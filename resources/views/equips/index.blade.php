<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __("Guia d'Equips") }}
    </h2>
  </x-slot>


  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

        <h1 class="text-3xl font-bold text-blue-800 mb-6">Guia d'Equips</h1>

        @if (session('success'))
          <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
        @endif

        <p class="mb-4">
          @can('create', App\Models\Equip::class)
            <a href="{{ route('equips.create') }}"
              class="bg-blue-600 text-white px-3 py-2 rounded">{{ __('Crear Equip')}}</a>
          @endcan
        </p>

        <table class="w-full border-collapse border border-gray-300">
          <thead class="bg-gray-200">
            <tr>
              <th class="border border-gray-300 p-2">{{ __('Nom')}}</th>
              <th class="border border-gray-300 p-2">{{ __('Estadi')}}</th>
              <th class="border border-gray-300 p-2">{{ __('Titols')}}</th>
              <th class="border border-gray-300 p-2">{{ __('Accions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($equips as $equip)
              <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">
                  <a href="{{ route('equips.show', $equip->id) }}"
                    class="text-blue-700 hover:underline">{{ $equip->nom }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $equip->estadi->nom }}</td>
                <td class="border border-gray-300 p-2">{{ $equip->titols }}</td>
                <td class="border border-gray-300 p-2">
                  <div class="flex space-x-2">
                    @can('update', $equip)
                      <a href="{{ route('equips.edit', $equip->id) }}"
                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 flex items-center space-x-1">
                        <span>✏️</span>
                      </a>
                    @endcan
                    @can('delete', $equip)
                      <form action="{{ route('equips.destroy', $equip->id) }}" method="POST"
                        onsubmit="return confirm('Segur que vols eliminar aquest equip?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 flex items-center space-x-1">
                          <span>🗑️</span>
                        </button>
                      </form>
                    @endcan
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>