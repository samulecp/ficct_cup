<div class="space-y-4">

    <div>
        <label class="block font-medium">Nombre</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre', $operador->nombre ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">CI</label>
        <input type="text"
               name="ci"
               value="{{ old('ci', $operador->ci ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Correo</label>
        <input type="email"
               name="correo"
               value="{{ old('correo', $operador->correo ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Teléfono</label>
        <input type="text"
               name="telefono"
               value="{{ old('telefono', $operador->telefono ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    @if(!isset($operador))
    <div>
        <label class="block font-medium">Contraseña</label>
        <input type="password"
               name="password"
               class="w-full border rounded p-2">
    </div>
    @endif

</div>