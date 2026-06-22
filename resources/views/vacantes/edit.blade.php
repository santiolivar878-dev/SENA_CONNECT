@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2>Editar vacante</h2>
                    <p class="text-muted">Modifica los detalles de tu vacante.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('vacantes.update', $vacante) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $vacante->titulo) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="5">{{ old('descripcion', $vacante->descripcion) }}</textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Modalidad</label>
                                <input type="text" name="modalidad" class="form-control" value="{{ old('modalidad', $vacante->modalidad) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $vacante->ubicacion) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="activa" {{ old('estado', $vacante->estado) === 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="cerrada" {{ old('estado', $vacante->estado) === 'cerrada' ? 'selected' : '' }}>Cerrada</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark">Actualizar vacante</button>
                            <a href="{{ route('vacantes.show', $vacante) }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
