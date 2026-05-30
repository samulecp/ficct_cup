<div class="space-y-4">

    <div>
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre', $periodo->nombre ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Nota de aprobación</label>
        <input type="number"
               step="0.01"
               name="nota_aprobacion"
               value="{{ old('nota_aprobacion', $periodo->nota_aprobacion ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Máximo alumnos por grupo</label>
        <input type="number"
               name="max_alumno_grupo"
               value="{{ old('max_alumno_grupo', $periodo->max_alumno_grupo ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Fecha inicio</label>
        <input type="date"
               name="fecha_inicio"
               value="{{ old('fecha_inicio', $periodo->fecha_inicio ?? '') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label>Fecha fin</label>
        <input type="date"
               name="fecha_fin"
               value="{{ old('fecha_fin', $periodo->fecha_fin ?? '') }}"
               class="w-full border rounded p-2">
    </div>

</div>