@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1>{{ $vacante->titulo }}</h1>
                    <p class="mb-1 text-muted">{{ $vacante->modalidad ?: 'Modalidad no especificada' }} · {{ $vacante->ubicacion ?: 'Ubicación no especificada' }}</p>
                    <p class="mb-1"><strong>Empresa:</strong> {{ $vacante->empresa->name }}</p>
                    <p class="mb-1"><strong>Estado:</strong> {{ ucfirst($vacante->estado) }}</p>
                    <p class="text-muted small">Publicado el {{ $vacante->fecha_publicacion->format('d/m/Y H:i') }}</p>

                    <div class="mt-4">
                        <h5>Descripción</h5>
                        <p>{{ $vacante->descripcion }}</p>
                    </div>

                    @auth
                        @if(auth()->user()->role->name === 'Empresa' && auth()->user()->id_usuario === $vacante->id_usuario)
                            <div class="mt-4 d-flex gap-2">
                                <a href="{{ route('vacantes.edit', $vacante) }}" class="btn btn-outline-dark">Editar</a>
                                <form action="{{ route('vacantes.destroy', $vacante) }}" method="POST" onsubmit="return confirm('¿Eliminar esta vacante?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm p-3">
                <h5>Acciones</h5>
                <a href="{{ route('vacantes.index') }}" class="btn btn-outline-dark w-100 mb-3">Volver a vacantes</a>

                @auth
                    @if(auth()->user()->role->name === 'Aprendiz')
                        <form method="POST" action="{{ route('vacantes.postular', $vacante) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Carta de presentación</label>
                                <textarea name="hoja_vida" class="form-control" rows="4">{{ old('hoja_vida') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Postularme</button>
                        </form>
                    @elseif(auth()->user()->role->name === 'Empresa')
                        <p class="text-muted">Solo los aprendices pueden postularse.</p>
                    @endif
                @else
                    <p class="text-muted">Inicia sesión para postularte.</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
