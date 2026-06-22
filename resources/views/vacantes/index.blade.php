@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Vacantes SENACONNECT</h1>
            <p class="text-muted">Encuentra oportunidades publicadas por empresas del SENA.</p>
        </div>
        @auth
            @if(auth()->user()->role->name === 'Empresa')
                <a href="{{ route('vacantes.create') }}" class="btn btn-dark">Publicar vacante</a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($vacantes->count())
        <div class="row g-4">
            @foreach($vacantes as $vacante)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $vacante->titulo }}</h5>
                            <p class="text-muted mb-1">{{ $vacante->modalidad ?: 'Presencial / Virtual' }} · {{ $vacante->ubicacion ?: 'Ubicación no especificada' }}</p>
                            <p class="mb-2">{{ \Illuminate\Support\Str::limit($vacante->descripcion, 140) }}</p>
                            <p class="mb-1"><strong>Empresa:</strong> {{ $vacante->empresa->name }}</p>
                            <p class="text-muted small">Publicado el {{ $vacante->fecha_publicacion->format('d/m/Y H:i') }}</p>
                            <a href="{{ route('vacantes.show', $vacante) }}" class="btn btn-outline-dark btn-sm">Ver detalle</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $vacantes->links() }}
        </div>
    @else
        <div class="alert alert-info">No hay vacantes publicadas todavía.</div>
    @endif
</div>
@endsection
