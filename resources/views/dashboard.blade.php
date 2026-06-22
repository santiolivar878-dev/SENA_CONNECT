@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2>Mi perfil</h2>
        <p class="text-muted">Bienvenido de nuevo, {{ Auth::user()->name }}. Aquí puedes consultar tu actividad en SENACONNECT.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Publicaciones</h5>
                    <p class="display-6">{{ $publicacionesCount }}</p>
                    <p class="text-muted mb-0">Publicaciones creadas por ti.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Vacantes</h5>
                    <p class="display-6">{{ $vacantesCount }}</p>
                    <p class="text-muted mb-0">Vacantes publicadas por tu empresa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Postulaciones</h5>
                    <p class="display-6">{{ $postulacionesCount }}</p>
                    <p class="text-muted mb-0">Postulaciones que has realizado o recibido.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Últimas publicaciones propias</h5>

                    @if($recentPublicaciones->count())
                        @foreach($recentPublicaciones as $publicacion)
                            <div class="mb-3">
                                <h6>{{ \Illuminate\Support\Str::limit($publicacion->contenido, 80) }}</h6>
                                <p class="text-muted small mb-1">Publicado el {{ $publicacion->fecha_publicacion->format('d/m/Y H:i') }}</p>
                                <p class="mb-0">{{ \Illuminate\Support\Str::limit($publicacion->contenido, 150) }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info mb-0">Aún no has publicado nada.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Acciones rápidas</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('publicaciones.create') }}" class="btn btn-dark w-100 mb-3">Crear publicación</a></li>
                        <li><a href="{{ route('vacantes.index') }}" class="btn btn-outline-dark w-100 mb-3">Buscar vacantes</a></li>
                        <li><a href="{{ route('postulaciones.index') }}" class="btn btn-outline-secondary w-100">Ver postulaciones</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection