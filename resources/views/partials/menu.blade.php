<nav>
  <ul class="flex space-x-4">
    <li><a class="{{ $linkClass ?? 'text-white hover:underline' }}" href="/">{{ __('Inici') }}</a></li>
    <li><a class="{{ $linkClass ?? 'text-white hover:underline' }}"
        href="{{ route('equips.index') }}">{{ __("Guia d'Equips") }}</a>
    </li>
    <li><a class="{{ $linkClass ?? 'text-white hover:underline' }}"
        href="{{ route('estadis.index') }}">{{ __("Llistat d'Estadis") }}</a></li>
    <li><a class="{{ $linkClass ?? 'text-white hover:underline' }}"
        href="{{ route('jugadores.index') }}">{{ __('Llistat de jugadores') }}</a></li>
    <li><a class="{{ $linkClass ?? 'text-white hover:underline' }}"
        href="{{ route('partits.index') }}">{{ __('Llistat de Partits') }}</a></li>
  </ul>
</nav>