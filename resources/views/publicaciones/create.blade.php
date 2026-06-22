@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2>Nueva publicación</h2>
                    <p class="text-muted">Comparte noticias, consejos o novedades con la comunidad del SENA.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('publicaciones.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Contenido</label>
                            <textarea name="contenido" class="form-control" rows="5" maxlength="140" required>{{ old('contenido') }}</textarea>
                            <small class="text-muted">Máximo 140 caracteres.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagen (URL)</label>
                            <input type="text" name="imagen" class="form-control" value="{{ old('imagen') }}" placeholder="https://...">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark">Publicar</button>
                            <a href="{{ route('publicaciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
