<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🏠</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Inicio
    </span>

</a>

<a href="{{ route('postulante.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('postulante.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">👥</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Postulantes
    </span>


<a href="{{ route('preinscripciones.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('preinscripciones.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📝</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Pre Inscripciones
    </span>

</a>

<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📊</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Reportes
    </span>

</a>