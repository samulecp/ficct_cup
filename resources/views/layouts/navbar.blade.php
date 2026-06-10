<nav class="bg-white shadow px-6 py-4 flex justify-between">

    <div>
        <h1 class="font-bold text-xl">
            @yield('title')
        </h1>
    </div>

    <div class="flex items-center gap-4">

        <a href="{{ route('profile.edit') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
             {{ auth()->user()->name }}
        </a>

        <form method="POST"
              action="{{ route('logout') }}">
            @csrf

            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                Salir
            </button>
        </form>

    </div>

</nav>