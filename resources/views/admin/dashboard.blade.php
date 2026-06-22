@extends('admin.layout')

@section('page-title', 'DASHBOARD')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Usuarios</div>
                <div class="stat-value">{{ \App\Models\User::count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Vacantes</div>
                <div class="stat-value">{{ \App\Models\Vacante::count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Postulaciones</div>
                <div class="stat-value">{{ \App\Models\Postulacion::count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Publicaciones</div>
                <div class="stat-value">{{ \App\Models\Publicacion::count() }}</div>
            </div>
        </div>
    </div>

    <table class="senaconnect-table mt-4">
        <thead>
            <tr>
                <th>Bienvenido</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hola, {{ Auth::user()->name }}. Este es tu panel de administración.</td>
            </tr>
        </tbody>
    </table>

@endsection