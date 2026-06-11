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

<a href="{{ route('postulante.misCalificaciones') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('postulante.misCalificaciones') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🗒</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Calificaciones
    </span>

</a>

<a href="{{ route('postulante.misClases') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('postulante.misClases') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📅</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Clases
    </span>

</a>


<a href="{{ route('postulante.misDocentes') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('postulante.misDocentes') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">👤</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Docentes
    </span>

</a>

<a href="{{ route('postulante.resultadoAcademico') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('postulante.resultadoAcademico') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🏅</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Resultado Académico
    </span>

</a>