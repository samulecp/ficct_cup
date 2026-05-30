@extends('layouts.app')

@section('title', 'Bitácora')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">

        Bitácora del Sistema

    </h1>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    Fecha
                </th>

                <th class="p-3 text-left">
                    Usuario
                </th>

                <th class="p-3 text-left">
                    Acción
                </th>

                <th class="p-3 text-left">
                    Módulo
                </th>

                <th class="p-3 text-left">
                    Descripción
                </th>

                <th class="p-3 text-left">
                    IP
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($logs as $log)

                <tr class="border-t">

                    <td class="p-3">

                        {{ $log->created_at->format('d/m/Y H:i') }}

                    </td>

                    <td class="p-3">

                        {{ $log->user->name ?? 'Sistema' }}

                    </td>

                    <td class="p-3">

                        {{ $log->accion }}

                    </td>

                    <td class="p-3">

                        {{ $log->modulo }}

                    </td>

                    <td class="p-3">

                        {{ $log->descripcion }}

                    </td>

                    <td class="p-3">

                        {{ $log->ip }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6"
                        class="p-4 text-center text-gray-500">

                        No existen registros.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>
    <div class="p-4">
    {{ $logs->links() }}
</div>

</div>

@endsection