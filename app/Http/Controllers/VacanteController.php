<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    public function index()
    {
        $vacantes = Vacante::with('empresa')
            ->orderByDesc('fecha_publicacion')
            ->paginate(10);

        return view('vacantes.index', compact('vacantes'));
    }

    public function create()
    {
        $this->authorizeEmpresa();
        return view('vacantes.create');
    }

    public function store(Request $request)
    {
        $this->authorizeEmpresa();

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'modalidad' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'required|string|max:50',
        ]);

        $data['id_usuario'] = auth()->user()->id_usuario;

        Vacante::create($data);

        return redirect()->route('vacantes.index')->with('success', 'Vacante creada correctamente.');
    }

    public function show(Vacante $vacante)
    {
        return view('vacantes.show', compact('vacante'));
    }

    public function edit(Vacante $vacante)
    {
        $this->authorizeEmpresa($vacante);
        return view('vacantes.edit', compact('vacante'));
    }

    public function update(Request $request, Vacante $vacante)
    {
        $this->authorizeEmpresa($vacante);

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'modalidad' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'required|string|max:50',
        ]);

        $vacante->update($data);

        return redirect()->route('vacantes.show', $vacante)->with('success', 'Vacante actualizada correctamente.');
    }

    public function destroy(Vacante $vacante)
    {
        $this->authorizeEmpresa($vacante);
        $vacante->delete();

        return redirect()->route('vacantes.index')->with('success', 'Vacante eliminada.');
    }

    protected function authorizeEmpresa(Vacante $vacante = null)
    {
        if (!auth()->user() || auth()->user()->role->name !== 'Empresa') {
            abort(403, 'Solo las empresas pueden administrar vacantes.');
        }

        if ($vacante && $vacante->id_usuario !== auth()->user()->id_usuario) {
            abort(403, 'No tienes permiso para administrar esta vacante.');
        }
    }
}
