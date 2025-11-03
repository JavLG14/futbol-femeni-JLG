@extends('layouts.app')
@section('title', "Detall d'Estadi")

@section('content')
<x-estadi 
  :nom="$estadi['nom']" 
  :localitat="$estadi['localitat']" 
  :aforament="$estadi['aforament']" 
  :equip="$estadi['equip']" 
/>
@endsection
