<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            <!-- Título -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Bienvenido
                </h1>
                <p class="text-sm text-gray-500">
                    Inicia sesión en tu sistema
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Correo
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                    <input type="password"
                           name="password"
                           required
                           class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center">
                    <input type="checkbox"
                           name="remember"
                           class="rounded border-gray-300 text-indigo-600">
                    <label class="ml-2 text-sm text-gray-600">
                        Recordarme
                    </label>
                </div>

                <!-- Botón -->
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg transition">
                    Ingresar
                </button>

            </form>
        </div>
    </div>
</x-guest-layout>