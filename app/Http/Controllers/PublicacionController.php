<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::with('usuario')
            ->orderByDesc('fecha_publicacion')
            ->paginate(10);

        return view('publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contenido' => 'required|string|max:140',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                ->store('publicaciones', 'public');
        }

        $data['id_usuario'] = auth()->user()->id_usuario;
        $data['fecha_publicacion'] = now();

        Publicacion::create($data);

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación creada correctamente.');
    }

    public function show(Publicacion $publicacion)
    {
        return view('publicaciones.show', compact('publicacion'));
    }
}