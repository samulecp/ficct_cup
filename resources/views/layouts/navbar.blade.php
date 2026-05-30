<nav class="bg-white shadow px-6 py-4 flex justify-between">

    <div>

        <h1 class="font-bold text-xl">

            @yield('title')

        </h1>

    </div>

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