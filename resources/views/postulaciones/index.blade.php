@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="mb-0">Postulaciones</h1>
            <p class="text-muted">Revisa tus postulaciones o las solicitudes para las vacantes de tu empresa.</p>
        </div>
        <a href="{{ route('vacantes.index') }}" class="btn btn-outline-dark">Ver vacantes</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($postulaciones->count())
        <div class="row g-4">
            @foreach($postulaciones as $postulacion)
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5>{{ $postulacion->vacante->titulo }}</h5>
                                    <p class="mb-1 text-muted">{{ $postulacion->vacante->empresa->name }}</p>
                                </div>
                                <span class="badge bg-{{ $postulacion->estado === 'pendiente' ? 'warning' : ($postulacion->estado === 'aceptada' ? 'success' : 'secondary') }} text-dark">{{ ucfirst($postulacion->estado) }}</span>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Publicado:</strong> {{ $postulacion->vacante->fecha_publicacion->format('d/m/Y') }}</p>
                                </div>
                                @if(auth()->user()->role->name === 'Empresa')
                                    <div class="col-md-6 text-md-end">
                                        <p class="mb-1"><strong>Postulante:</strong> {{ $postulacion->usuario->name }}</p>
                                    </div>
                                @endif
                            </div>

                            @if($postulacion->hoja_vida)
                                <div class="mt-3">
                                    <h6>Carta / Hoja de vida</h6>
                                    <p>{{ $postulacion->hoja_vida }}</p>
                                </div>
                            @endif

                            <div class="mt-3">
                                <a href="{{ route('vacantes.show', $postulacion->vacante) }}" class="btn btn-outline-dark btn-sm">Ver vacante</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No hay postulaciones registradas.</div>
    @endif
</div>
@endsection
