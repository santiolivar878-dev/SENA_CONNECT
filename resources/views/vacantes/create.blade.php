@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2>Publicar nueva vacante</h2>
                    <p class="text-muted">Comparte oportunidades para estudiantes del SENA.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('vacantes.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="5">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Modalidad</label>
                                <input type="text" name="modalidad" class="form-control" value="{{ old('modalidad') }}" placeholder="Presencial / Remoto">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}" placeholder="Ciudad / Región">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="activa" selected>Activa</option>
                                <option value="cerrada">Cerrada</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark">Publicar vacante</button>
                            <a href="{{ route('vacantes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
