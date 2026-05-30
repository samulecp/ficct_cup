<!DOCTYPE html>
<html lang="es">

<head>
    <style>
[x-cloak] {
    display: none !important;
}
</style>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-gray-100">

<div x-data="{ sidebarOpen: true }"
     class="flex min-h-screen">

    {{-- SIDEBAR --}}
<aside
    :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="bg-gray-900 text-white transition-all duration-300 min-h-screen">

    {{-- LOGO --}}
    <div class="flex items-center justify-between p-4 border-b border-gray-700">

        <span x-show="sidebarOpen"
      x-transition
      x-cloak
      class="text-xl font-bold">
    CUP FICCT
</span>

        <button @click="sidebarOpen = !sidebarOpen"
                class="text-white text-xl">
            ☰
        </button>

    </div>

    {{-- MENÚ DINÁMICO POR ROL --}}
    <nav class="p-4 space-y-2">

        @role('administrador')
            @include('layouts.sidebar.administrador')
        @endrole

        @role('operador')
            @include('layouts.sidebar.operador')
        @endrole

        @role('docente')
            @include('layouts.sidebar.docente')
        @endrole

        @role('postulante')
            @include('layouts.sidebar.postulante')
        @endrole

    </nav>

</aside>

    {{-- CONTENIDO --}}
    <div class="flex-1 flex flex-col">

        {{-- NAVBAR --}}
        <nav class="bg-white shadow px-6 py-4 flex justify-between">

            <h1 class="font-bold text-xl">
                @yield('title')
            </h1>

            <div class="flex items-center gap-4">

                <span>
                    {{ auth()->user()->name }}
                </span>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button class="bg-red-500 text-white px-4 py-2 rounded">

                        Salir

                    </button>

                </form>

            </div>

        </nav>

        {{-- MAIN --}}
        <main class="p-6">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     