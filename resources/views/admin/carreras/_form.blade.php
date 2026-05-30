<div class="space-y-4">

    <div>

        <label class="block font-medium">
            Nombre
        </label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre', $carrera->nombre ?? '') }}"
               class="w-full border rounded p-2">

    </div>

    <div>

        <label class="block font-medium">
            Cupo
        </label>

        <input type="number"
               name="cupo"
               value="{{ old('cupo', $carrera->cupo ?? '') }}"
               class="w-full border rounded p-2">

    </div>

</div>