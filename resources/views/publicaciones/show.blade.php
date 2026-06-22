@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h4">{{ \Illuminate\Support\Str::limit($publicacion->contenido, 60) }}</h1>
                            <p class="text-muted mb-1">{{ $publicacion->usuario->name }}</p>
                            <p class="text-muted small">{{ $publicacion->fecha_publicacion->format('d/m/Y H:i') }}</p>
                        </div>
                        @if($publicacion->imagen)
                            <img src="{{ $publicacion->imagen }}" alt="Imagen" class="rounded" style="width:80px; height:80px; object-fit:cover;">
                        @endif
                    </div>

                    <p>{{ $publicacion->contenido }}</p>
                    <a href="{{ route('publicaciones.index') }}" class="btn btn-outline-dark btn-sm">Volver al feed</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
