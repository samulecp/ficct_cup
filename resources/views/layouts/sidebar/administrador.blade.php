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

<div x-data="{ openSeguridad: false }">

    <button
        @click="openSeguridad = !openSeguridad"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-700">

        <span class="flex items-center gap-2">

            🔒

            <span x-show="sidebarOpen">
                Seguridad
            </span>

        </span>

        <svg
            :class="{ 'rotate-90': openSeguridad }"
            class="w-4 h-4 transition-transform duration-200"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>

        </svg>

    </button>

    <div x-show="sidebarOpen && openSeguridad"
         x-transition
         class="ml-4 mt-2 space-y-1">

        <a href="{{ route('admin.usuarios.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Usuarios
        </a>

        <a href="{{ route('admin.administradores.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Administradores
        </a>

        <a href="{{ route('admin.operadores.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Operadores
        </a>

        
        <a href="{{ route('admin-postulantes.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Postulantes
        </a>

        <a href="{{ route('admin.docentes.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-700">
            Docentes
        </a>

    </div>

</div>

<div x-data="{ openLogistica: false }">

    <button
        @click="openLogistica = !openLogistica"
        class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-gray-800 transition">

        <span class="flex items-center gap-2">

            🔧

            <span x-show="sidebarOpen">
                Logística
            </span>

        </span>

        <svg x-show="sidebarOpen"
             :class="openLogistica ? 'rotate-90' : ''"
             class="w-4 h-4 transition-transform"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>

        </svg>

    </button>

    <div x-show="sidebarOpen && openLogistica"
         x-transition
         class="ml-6 mt-2 space-y-1">

        <a href="{{ route('admin.periodos.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">
            Periodos
        </a>

        <a href="{{ route('horarios.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">
            Horarios
        </a>

        <a href="{{ route('admin.aulas.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">
            Aulas
        </a>

        <a href="{{ route('admin.materias.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">
            Materias
        </a>

        <a href="{{ route('admin.carreras.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">
            Carreras
        </a>

    </div>

</div>

<div x-data="{ openPreinscripcion: false }">

    <button
        @click="openPreinscripcion = !openPreinscripcion"
        class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-gray-800 transition">

        <span class="flex items-center gap-2">

            📝

            <span x-show="sidebarOpen">
                Preinscripción
            </span>

        </span>

        <svg x-show="sidebarOpen"
             :class="openPreinscripcion ? 'rotate-90' : ''"
             class="w-4 h-4 transition-transform"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>

        </svg>

    </button>

    <div x-show="sidebarOpen && openPreinscripcion"
         x-transition
         class="ml-6 mt-2 space-y-1">

        <a href="{{ route('preinscripciones.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">

            Preinscripciones

        </a>

        <a href="{{ route('grupos.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-800">

            Grupos

        </a>

    </div>

</div>


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

<a href="{{ route('calificaciones.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>💯</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Calificaciones


    </span>

</a>

<a href="{{ route('admin.resultados.index') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>📌</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Resultados


    </span>

</a>

<a href="{{ route('reportes.academico') }}"
   class="flex items-center p-2 rounded hover:bg-gray-700">

    <span>📊</span>

    <span x-show="sidebarOpen"
          x-transition
          x-cloak
          class="ml-3">

        Reportes


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