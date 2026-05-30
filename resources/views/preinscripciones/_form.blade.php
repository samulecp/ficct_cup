<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="block mb-1 font-semibold">
            CI
        </label>

        <input type="text"
               name="ci"
               value="{{ old('ci') }}"
               class="w-full border rounded p-2"
               required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Extensión
        </label>

        <input type="text"
               name="extension"
               value="{{ old('extension') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Nombre Completo
        </label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre') }}"
               class="w-full border rounded p-2"
               required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Correo
        </label>

        <input type="email"
               name="correo"
               value="{{ old('correo') }}"
               class="w-full border rounded p-2"
               required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Teléfono
        </label>

        <input type="text"
               name="telefono"
               value="{{ old('telefono') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            RUDE
        </label>

        <input type="text"
               name="rude"
               value="{{ old('rude') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Periodo
        </label>

        <select name="periodo_id"
                class="w-full border rounded p-2"
                required>

            <option value="">
                Seleccione
            </option>

            @foreach($periodos as $periodo)

                <option value="{{ $periodo->id }}">

                    {{ $periodo->nombre }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Primera Opción
        </label>

        <select name="carrera_primera_id"
                class="w-full border rounded p-2"
                required>

            <option value="">
                Seleccione
            </option>

            @foreach($carreras as $carrera)

                <option value="{{ $carrera->id }}">

                    {{ $carrera->nombre }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold">
            Segunda Opción
        </label>

        <select name="carrera_segunda_id"
                class="w-full border rounded p-2"
                required>

            <option value="">
                Seleccione
            </option>

            @foreach($carreras as $carrera)

                <option value="{{ $carrera->id }}">

                    {{ $carrera->nombre }}

                </option>

            @endforeach

        </select>
    </div>

</div>