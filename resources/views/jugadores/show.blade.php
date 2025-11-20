@extends('layouts.app')
@section('title', "Detall de jugadora")

@section('content')
<x-jugadora 
    :nom="$jugadora->nom" 
    :equip="$jugadora->equip?->nom ?? 'Sense equip'" 
    :data="$jugadora->data_naixement" 
    :dorsal="$jugadora->dorsal" 
    :foto="$jugadora->foto"
/>
@endsection
