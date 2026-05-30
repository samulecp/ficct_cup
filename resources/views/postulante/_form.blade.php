<div class="space-y-4">

    <div>
        <label class="block font-medium">CI</label>
        <input type="text"
               name="ci"
               value="{{ old('ci', $postulante->ci ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Extensión</label>
        <input type="text"
               name="extension"
               value="{{ old('extension', $postulante->extension ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Nombre</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre', $postulante->nombre ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Correo</label>
        <input type="email"
               name="correo"
               value="{{ old('correo', $postulante->correo ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Teléfono</label>
        <input type="text"
               name="telefono"
               value="{{ old('telefono', $postulante->telefono ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">RUDE</label>
        <input type="text"
               name="rude"
               value="{{ old('rude', $postulante->rude ?? '') }}"
               class="w-full border rounded p-2">
    </div>

</div>