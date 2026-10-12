<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TipoPersonaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RegistroBiometricoController;
use App\Http\Controllers\TipoDispositivoController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\CapturaImagenController;
use App\Http\Controllers\EmbeddingController;
use App\Http\Controllers\TipoEventoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\Biometrico\RegistroController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\RelacionesController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\NinosController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tipo_personas', TipoPersonaController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('personas', PersonaController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('registro_biometrico', RegistroBiometricoController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('tipo_dispositivos', TipoDispositivoController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('dispositivos', DispositivoController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('ubicaciones', UbicacionController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('captura_imagen', CapturaImagenController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('embeddings', EmbeddingController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('tipo_eventos', TipoEventoController::class);
    Route::resource('eventos', EventoController::class);
});
/////
Route::middleware(['auth'])->group(function(){
    Route::get('biometrico/registro/create', [RegistroController::class,'create'])->name('biometrico.create');
    Route::post('biometrico/registro', [RegistroController::class,'store'])->name('biometrico.store');
    Route::post('biometrico/captura', [RegistroController::class,'capturaAjax'])->name('biometrico.captura'); // para webcam
});
Route::resource('registro-biometrico', RegistroBiometricoController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('registro_biometrico', [RegistroBiometricoController::class,'create'])->name('registro_biometrico.create');
    Route::post('registro_biometrico', [RegistroBiometricoController::class,'store'])->name('registro_biometrico.store');
});
/////

Route::get('/reconocimiento', [ReconocimientoController::class, 'index'])->name('reconocimiento.index');
Route::post('/reconocimiento/procesar', [ReconocimientoController::class, 'procesar'])->name('reconocimiento.procesar');
Route::post('/reconocer', [ReconocimientoController::class, 'reconocer']);

Route::resource('relaciones', RelacionesController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/relaciones', [RelacionesController::class, 'index'])->name('relaciones.index');
    Route::post('/relaciones', [RelacionesController::class, 'store'])->name('relaciones.store');
    Route::delete('/relaciones/{relacion}', [RelacionesController::class, 'destroy'])->name('relaciones.destroy');
});

// Reportes
Route::get('/reportes/eventos', [ReportesController::class, 'reporteEventos'])->name('reportes.eventos');
Route::get('/reportes/parentescos', [ReportesController::class, 'reporteParentescos'])->name('reportes.parentescos');
Route::get('/reportes/persona/{id}', [ReportesController::class, 'reportePersona'])->name('reportes.persona');
Route::get('/reportes', [ReportesController::class, 'menu'])->name('reportes.menu');
Route::get('/reportes/buscar-persona', [ReportesController::class, 'buscarPersona'])
    ->name('reportes.buscarPersona');
Route::get('/reportes/dashboard', [ReportesController::class, 'dashboard'])
    ->name('reportes.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/ninos', [NinosController::class, 'index'])
        ->name('ninos.index');
    Route::get('/ninos/{id}/pdf', [NinosController::class, 'pdf'])
        ->name('ninos.pdf');

});
