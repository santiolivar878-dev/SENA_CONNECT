<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\PublicacionController;
use App\Models\Publicacion;

// Ruta principal (feed en la página de bienvenida)
Route::get('/', function () {
    $publicaciones = Publicacion::with('usuario')
        ->orderByDesc('fecha_publicacion')
        ->paginate(6);

    return view('welcome', compact('publicaciones'));
});

// Feed público de publicaciones
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/publicaciones/{publicacion}', [PublicacionController::class, 'show'])->whereNumber('publicacion')->name('publicaciones.show');

// Dashboard (Aprendiz / general)
Route::get('/dashboard', function () {
    $user = auth()->user();
    $publicacionesCount = $user->publicaciones()->count();
    $vacantesCount = $user->vacantes()->count();
    $postulacionesCount = $user->postulaciones()->count();
    $recentPublicaciones = $user->publicaciones()->orderByDesc('fecha_publicacion')->take(3)->get();

    return view('dashboard', compact('publicacionesCount', 'vacantesCount', 'postulacionesCount', 'recentPublicaciones'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard de Empresa
Route::get('/empresa/dashboard', function () {
    $user = auth()->user();
    $vacantesCount = $user->vacantes()->count();
    $recentVacantes = $user->vacantes()->orderByDesc('created_at')->take(5)->get();

    return view('empresa.dashboard', compact('vacantesCount', 'recentVacantes'));
})->middleware(['auth', 'verified', 'role:Empresa'])->name('empresa.dashboard');

// Dashboard de Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

// Dashboard de Empleado
Route::get('/empleado/dashboard', function () {
    return view('empleado.dashboard');
})->middleware(['auth', 'verified', 'role:empleado'])->name('empleado.dashboard');

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Red social SENACONNECT
    Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
    Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');
    Route::get('/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones.index');

    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');

    Route::middleware('role:Empresa')->group(function () {
        Route::get('/vacantes/crear', [VacanteController::class, 'create'])->name('vacantes.create');
        Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
        Route::get('/vacantes/{vacante}/editar', [VacanteController::class, 'edit'])->name('vacantes.edit');
        Route::put('/vacantes/{vacante}', [VacanteController::class, 'update'])->name('vacantes.update');
        Route::delete('/vacantes/{vacante}', [VacanteController::class, 'destroy'])->name('vacantes.destroy');
    });

    Route::middleware('role:Aprendiz')->group(function () {
        Route::post('/vacantes/{vacante}/postular', [PostulacionController::class, 'store'])->name('vacantes.postular');
    });
});

// Rutas Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('envios', EnvioController::class);
});

// Rutas Empleado
Route::middleware(['auth', 'role:empleado'])->prefix('empleado')->group(function () {
    Route::resource('ventas', VentaController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('envios', EnvioController::class);
    Route::resource('proveedores', ProveedorController::class);
});

// Autenticación
require __DIR__.'/auth.php';