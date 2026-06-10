@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

<div class="space-y-6">

    <div class="bg-white p-6 rounded shadow">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bg-white p-6 rounded shadow">
        @include('profile.partials.update-password-form')
    </div>

    <div class="bg-white p-6 rounded shadow">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection