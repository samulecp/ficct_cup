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

<a href="{{ route('admin-postulantes.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('admin-postulantes.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">👥</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Postulantes
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

<a href="{{ route('reportes.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('reportes.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📊</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Reportes
    </span>

</a>

<a href="{{ route('grupos.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('grupos.*') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">👥</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Grupos
    </span>

</a>

<a href="{{ route('clases.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>🏛</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Clase

    </span>

</a>


<a href="{{ route('postulaciones.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>📁</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Postulaciones


    </span>

</a>