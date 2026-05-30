<a href="{{ route('admin.dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🏠</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Inicio
    </span>

</a>

<a href="{{ route('admin.logs.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>📋</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Bitácora

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

</a>

<a href="{{ route('admin.carreras.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('admin.carreras.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🎓</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Carreras
    </span>

</a>

<a href="{{ route('admin.operadores.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('admin.operadores.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">💻</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Operadores
    </span>

</a>

<a href="{{ route('admin.periodos.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('admin.periodos.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📅</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Periodos
    </span>

</a>

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