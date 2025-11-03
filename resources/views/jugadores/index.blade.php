@extends('layouts.app')
@section('title', "Llista de jugadores")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llista de jugadores</h1>

@if (session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
  <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Nova jugadora</a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
  <tr>
    <th class="border border-gray-300 p-2">Nom</th>
    <th class="border border-gray-300 p-2">Equip</th>
    <th class="border border-gray-300 p-2">Posició</th>
  </tr>
  </thead>
  <tbody>
  @foreach($jugadores as $jugadora)
    <x-jugadora :nom="$jugadora['nom']" :equip="$jugadora['equip']" :posicio="$jugadora['posicio']"/>
  @endforeach
  </tbody>
</table>
@endsection
