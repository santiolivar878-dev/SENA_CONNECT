@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Feed SENACONNECT</h1>
            <p class="text-muted">Publicaciones de estudiantes, empresas y el SENA.</p>
        </div>
        @auth
            <a href="{{ route('publicaciones.create') }}" class="btn btn-dark">Nueva publicación</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($publicaciones->count())
        <div class="row g-4">
            @foreach($publicaciones as $publicacion)
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1">
                                        <a href="{{ route('publicaciones.show', $publicacion) }}" class="text-dark text-decoration-none">{{ \Illuminate\Support\Str::limit($publicacion->contenido, 100) }}</a>
                                    </h5>
                                    <p class="mb-1 text-muted">{{ $publicacion->usuario->name }} · {{ $publicacion->fecha_publicacion->diffForHumans() }}</p>
                                </div>
                                @if($publicacion->imagen)
                                    <img src="{{ $publicacion->imagen }}" alt="Imagen" class="rounded" style="width:64px; height:64px; object-fit:cover;">
                                @endif
                            </div>

                            <p>{{ $publicacion->contenido }}</p>
                            <a href="{{ route('publicaciones.show', $publicacion) }}" class="btn btn-outline-dark btn-sm">Ver publicación</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $publicaciones->links() }}
        </div>
    @else
        <div class="alert alert-info">Aún no hay publicaciones en el feed.</div>
    @endif
</div>
@endsection
