<x-mail::message>
    # Hola {{ $nom }},

    A continuació tens el teu calendari de partits assignats:

@foreach($partits as $partit)
- **Jornada {{ $partit->jornada }}**: **{{ $partit->local->nom }}** vs **{{ $partit->visitant->nom }}**
  Data: {{ $partit->data->format('d/m/Y H:i') }} | Estadi: {{ $partit->estadi->nom ?? 'Sense estadi' }}
@endforeach

    Gràcies,<br>
    {{ config('app.name') }}
</x-mail::message>