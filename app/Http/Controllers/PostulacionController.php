<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use App\Models\Vacante;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role->name === 'Empresa') {
            $postulaciones = Postulacion::with(['vacante', 'usuario'])
                ->whereHas('vacante', function ($query) use ($user) {
                    $query->where('id_usuario', $user->id_usuario);
                })
                ->orderByDesc('fecha_postulacion')
                ->get();
        } else {
            $postulaciones = Postulacion::with('vacante')
                ->where('id_usuario', $user->id_usuario)
                ->orderByDesc('fecha_postulacion')
                ->get();
        }

        return view('postulaciones.index', compact('postulaciones'));
    }

    public function store(Request $request, Vacante $vacante)
    {
        if (auth()->user()->role->name !== 'Aprendiz') {
            abort(403, 'Solo los aprendices pueden postularse a vacantes.');
        }

        $request->validate([
            'hoja_vida' => 'nullable|string',
        ]);

        $existing = Postulacion::where('id_vacante', $vacante->id_vacante)
            ->where('id_usuario', auth()->user()->id_usuario)
            ->first();

        if ($existing) {
            return back()->with('error', 'Ya te postulaste a esta vacante.');
        }

        Postulacion::create([
            'id_vacante' => $vacante->id_vacante,
            'id_usuario' => auth()->user()->id_usuario,
            'hoja_vida' => $request->input('hoja_vida'),
            'estado' => 'pendiente',
        ]);

        return redirect()->route('postulaciones.index')->with('success', 'Postulación enviada con éxito.');
    }
}
