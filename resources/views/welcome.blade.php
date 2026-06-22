@extends('layouts.app')

@section('content')

<div style="background:#fff; color:#000; min-height:90vh;">
    <div class="container-fluid" style="padding:24px;">
        <div class="row" style="gap:18px;">
            <!-- Left sidebar -->
            <aside class="col-lg-2 d-none d-lg-block">
                <div style="border:2px solid #2f9e44; border-radius:8px; padding:16px;">
                    <h4 style="margin:0 0 12px 0; font-weight:700;">SENACONNECT</h4>
                    <nav style="display:flex; flex-direction:column; gap:8px;">
                        <a href="{{ url('/') }}" style="color:#000; text-decoration:none;">Inicio</a>
                        <a href="{{ route('dashboard') }}" style="color:#000; text-decoration:none;">Perfil</a>
                    </nav>
                </div>
            </aside>

            <!-- Main feed -->
            <main class="col-lg-7" style="min-height:60vh;">
                <!-- Composer button (opens modal) -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <div style="display:flex; gap:12px; align-items:center;">
                        <div style="border:2px solid #2f9e44; border-radius:8px; padding:10px 14px;">
                            <strong style="color:#000;">{{ auth()->check() ? auth()->user()->name : 'Invitado' }}</strong>
                        </div>
                        <div style="color:#666; font-size:12px;">{{ now()->format('d/m/Y H:i') }}</div>
                    </div>
                    <div>
                        @auth
                            <button class="btn btn-senaconnect" data-bs-toggle="modal" data-bs-target="#createPostModal" title="Crear publicación">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="vertical-align:middle; margin-right:8px;"><path d="M15.854.146a.5.5 0 0 0-.525-.08L.5 6.277v3.972c0 .346.186.66.485.828l4.5 2.5a.5.5 0 0 0 .73-.447V9.5L15.933.672a.5.5 0 0 0-.079-.525zM6 11.5v2.5L3.5 12 6 11.5z"/></svg>
                                Publicar
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-senaconnect">Iniciar sesión</a>
                        @endauth
                    </div>
                </div>

                <!-- Modal: Create Post -->
                <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom:2px solid #e9ecef;">
                                <h5 class="modal-title" id="createPostModalLabel">Crear publicación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <form method="POST" action="{{ route('publicaciones.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3 d-flex align-items-center gap-3">
                                        <div style="width:48px; height:48px; border-radius:50%; background:#f0f0f0; display:flex; align-items:center; justify-content:center;">@if(auth()->check()) {{ strtoupper(substr(auth()->user()->name,0,1)) }} @endif</div>
                                        <div>
                                            <div style="font-weight:700;">{{ auth()->check() ? auth()->user()->name : 'Invitado' }}</div>
                                            <div style="font-size:12px; color:#666;">{{ now()->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Contenido</label>
                                        <textarea name="contenido" class="form-control" rows="5" maxlength="1000" required placeholder="¿Qué quieres compartir?"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Imagen</label>
                                        <input type="file" name="imagen" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-senaconnect">Publicar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Feed posts -->
                @if(isset($publicaciones) && $publicaciones->count())
                    @foreach($publicaciones as $publicacion)
                        <article style="border:1px solid #e9ecef; border-left:6px solid #2f9e44; border-radius:8px; padding:16px; margin-bottom:12px; background:#fff;">
                            <div style="display:flex; justify-content:space-between; align-items:start; gap:12px;">
                                <div>
                                    <strong style="color:#000;">{{ $publicacion->usuario->name }}</strong>
                                    <div style="font-size:12px; color:#666;">{{ optional($publicacion->fecha_publicacion)->diffForHumans() }}</div>
                                </div>

                            </div>
                            <p style="margin-top:12px; color:#000;">{{ \Illuminate\Support\Str::limit($publicacion->contenido, 400) }}</p>
                            @if($publicacion->imagen)
    <div style="margin-top:12px;">
        <img src="{{ asset('storage/' . $publicacion->imagen) }}"
             style="width:100%; max-height:600px; object-fit:cover; border-radius:12px; margin-top:10px;">
    </div>
@endif
                            <div style="display:flex; gap:8px; margin-top:8px;">
                                <form method="POST" action="#">
                                    @csrf
                                    <button class="btn btn-sm" style="background:transparent; border:1px solid #2f9e44; color:#2f9e44;">❤ Me gusta</button>
                                </form>
                                <a href="{{ route('publicaciones.show', $publicacion) }}" class="btn btn-sm" style="background:transparent; border:1px solid #2f9e44; color:#2f9e44;">💬 Comentar</a>
                            </div>
                        </article>
                    @endforeach

                    <div class="mt-3">
                        {{ $publicaciones->links() }}
                    </div>
                @else
                    <div style="border:1px dashed #2f9e44; border-radius:8px; padding:20px; text-align:center;">
                        <p style="margin:0;">No hay publicaciones aún. Sé el primero en publicar.</p>
                    </div>
                @endif
            </main>

            <!-- Right sidebar -->
            <aside class="col-lg-3 d-none d-lg-block">
                <div style="border:2px solid #2f9e44; border-radius:8px; padding:12px; margin-bottom:12px; background:#fff;">
                    <h5 style="margin-top:0;">Noticias Importantes</h5>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        <div style="border:1px solid #e9ecef; padding:8px;">Noticia 1</div>
                        <div style="border:1px solid #e9ecef; padding:8px;">Noticia 2</div>
                        <div style="border:1px solid #e9ecef; padding:8px;">Noticia 3</div>
                    </div>
                </div>

                <div style="border:2px solid #2f9e44; border-radius:8px; padding:12px; background:#fff;">
                    <h6 style="margin-top:0;">Enlaces</h6>
                    <ul style="padding-left:16px;">
                        <li><a href="#">SENA</a></li>
                        <li><a href="#">Bolsa de empleo</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

@endsection