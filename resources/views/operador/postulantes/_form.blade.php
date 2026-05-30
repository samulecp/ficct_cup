<div class="space-y-4">

    <div>
        <label>CI</label>
        <input type="text"
               name="ci"
               value="{{ old('ci', $postulante->ci ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Extensión</label>
        <input type="text"
               name="extension"
               value="{{ old('extension', $postulante->extension ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Nombre Completo</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre', $postulante->nombre ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Correo</label>
        <input type="email"
               name="correo"
               value="{{ old('correo', $postulante->correo ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               value="{{ old('telefono', $postulante->telefono ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>RUDE</label>
        <input type="text"
               name="rude"
               value="{{ old('rude', $postulante->rude ?? '') }}"
               class="w-full border rounded p-2">
    </div>

</div>