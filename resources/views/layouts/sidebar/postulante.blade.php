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

<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🗒</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Notas
    </span>

</a>

<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">📅</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Clases
    </span>

</a>


<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">👤</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mis Docentes
    </span>

</a>

<a href="{{ route('dashboard') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700
   {{ request()->routeIs('') ? 'bg-gray-700' : '' }}">

    <span class="text-lg">🏅</span>

    <span x-show="sidebarOpen"
          x-transition
          class="ml-3">
        Mi Promedio
    </span>

</a>