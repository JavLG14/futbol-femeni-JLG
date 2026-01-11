<div>
    <div class="flex space-x-4">
        <input wire:model="equip" type="text" placeholder="{{ __('Cerca equip') }}" class="border px-4 py-2">
        <input wire:model="data" type="date" class="border px-4 py-2">
        <x-primary-button wire:click="filtrar">
            {{ __('Filtrar') }}
        </x-primary-button>
    </div>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('jornada')">
                    {{ __('Jornada') }} @if($sortField === 'jornada') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('data')">
                    {{ __('Data') }} @if($sortField === 'data') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('local')">
                    {{ __('Equip Local') }} @if($sortField === 'local') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('visitant')">
                    {{ __('Equip Visitant') }} @if($sortField === 'visitant') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('resultat')">
                    {{ __('Resultat') }} @if($sortField === 'resultat') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('estadi')">
                    {{ __('Estadi') }} @if($sortField === 'estadi') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
                <th class="cursor-pointer hover:bg-gray-100" wire:click="sortBy('arbitre')">
                    {{ __('Àrbitre') }} @if($sortField === 'arbitre') {{ $sortDirection === 'asc' ? '↑' : '↓' }} @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($partits as $partit)
                <tr>
                    <td class="text-center">{{ $partit->jornada }}</td>
                    <td>{{ $partit->data->format('d/m/Y') }}</td>
                    <td>{{ $partit->equipLocal->nom }}</td>
                    <td>{{ $partit->equipVisitant->nom }}</td>
                    <td>{{ $partit->resultat }}</td>
                    <td>{{ $partit->estadi->nom ?? __('Sense estadi') }}</td>
                    <td>{{ $partit->arbitre->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>