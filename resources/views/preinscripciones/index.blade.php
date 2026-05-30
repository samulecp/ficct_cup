@extends('layouts.app')

@section('title', 'Preinscripciones')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">

        Preinscripciones

    </h1>

    <a href="{{ route('preinscripciones.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">

        Nueva Preinscripción

    </a>

</div>

@if(session('success'))

    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

        {{ session('success') }}

    </div>

@endif

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    CI
                </th>

                <th class="p-3 text-left">
                    Nombre
                </th>

                <th class="p-3 text-left">
                    Periodo
                </th>

                <th class="p-3 text-left">
                    Primera Opción
                </th>

                <th class="p-3 text-left">
                    Segunda Opción
                </th>

                <th class="p-3 text-left">
                    Grupo
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($preinscripciones as $pre)

                <tr class="border-t">

                    <td class="p-3">

                        {{ $pre->postulante->ci }}

                    </td>

                    <td class="p-3">

                        {{ $pre->postulante->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->periodo->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->carreraPrimera->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->carreraSegunda->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->grupo?->nombre ?? 'Sin asignar' }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection