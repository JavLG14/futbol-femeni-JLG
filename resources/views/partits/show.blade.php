@extends('layouts.app')
@section('title', "Detall de jugadora")

@section('content')
<x-partit 
  :local="$partit['local']" 
  :visitant="$partit['visitant']" 
  :data="$partit['data']"
  :resultat="$partit['resultat']"
/>
@endsection