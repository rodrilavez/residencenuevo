@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center bg-primary text-white mb-4">
        <h1 class="display-4">Dashboard</h1>
        <p class="lead">Bienvenido, {{ Auth::user()->name }} (Rol: {{ Auth::user()->role }})</p>
    </div>

    @if(Auth::user()->role === 'admin')
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Zonas</h2>
            </div>
            <div class="card-body">
                @livewire('zonas-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Propiedades</h2>
            </div>
            <div class="card-body">
                @livewire('propiedades-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Guardias</h2>
            </div>
            <div class="card-body">
                @livewire('guardias-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Residentes</h2>
            </div>
            <div class="card-body">
                @livewire('residentes-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Horarios</h2>
            </div>
            <div class="card-body">
                @livewire('horarios-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Usuarios</h2>
            </div>
            <div class="card-body">
                @livewire('users-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Gestión de Incidencias</h2>
            </div>
            <div class="card-body">
                @livewire('incidencias-table')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Reservar Amenidad</h2>
            </div>
            <div class="card-body">
                @livewire('reservar-amenidad')
            </div>
        </div>
    @elseif(Auth::user()->role === 'guard')
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Mis Horarios</h2>
            </div>
            <div class="card-body">
                @livewire('mis-horarios')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Registro de Actividades</h2>
            </div>
            <div class="card-body">
                @livewire('registro-de-actividades')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Notificaciones</h2>
            </div>
            <div class="card-body">
                @livewire('notificaciones-guardia')
            </div>
        </div>
    @elseif(Auth::user()->role === 'residente')
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Mis Propiedades</h2>
            </div>
            <div class="card-body">
                @livewire('mis-propiedades')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Reportar Incidencia</h2>
            </div>
            <div class="card-body">
                @livewire('incidencia-form')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2>Reservar Amenidad</h2>
            </div>
            <div class="card-body">
                @livewire('reservar-amenidad')
            </div>
        </div>
    @endif
</div>
@endsection
