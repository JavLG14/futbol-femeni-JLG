<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Classificació</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Equip</th>
                    <th class="py-3 px-6 text-center">Punts</th>
                    <th class="py-3 px-6 text-center">Victòries</th>
                    <th class="py-3 px-6 text-center">Empats</th>
                    <th class="py-3 px-6 text-center">Derrotes</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($classificacio as $index => $equip)
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-100 {{ $equip['variation'] === 'increase' ? 'bg-green-100' : ($equip['variation'] === 'decrease' ? 'bg-red-100' : '') }}">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                @if($equip['escut'])
                                    <img src="{{ asset('storage/' . $equip['escut']) }}" alt="{{ $equip['equip'] }}"
                                        class="w-6 h-6 mr-2">
                                @endif
                                <span class="font-medium">{{ $index + 1 }}. {{ $equip['equip'] }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center font-bold">{{ $equip['punts'] }}</td>
                        <td class="py-3 px-6 text-center text-green-600">{{ $equip['victories'] }}</td>
                        <td class="py-3 px-6 text-center text-yellow-600">{{ $equip['empats'] }}</td>
                        <td class="py-3 px-6 text-center text-red-600">{{ $equip['derrotes'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>