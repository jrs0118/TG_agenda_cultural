<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;       
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CategoriaController;

// Página principal (pública)
Route::get('/', [HomeController::class, 'index'])->name('home');

// PRIMERO: Rutas específicas de eventos (create debe ir ANTES que {evento})
Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create')->middleware('auth');
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store')->middleware('auth');

// SEGUNDO: Ruta pública de detalle (DEBE IR DESPUÉS de create)
Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');

// TERCERO: Rutas protegidas restantes (edit, update, destroy)
Route::middleware(['auth'])->group(function () {
    Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
    
    // CRUDs completos para otros módulos
    Route::resource('categorias', CategoriaController::class);
    Route::resource('ubicaciones', UbicacionController::class);
    
    // Listado de eventos (protegido)
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index')->middleware('auth');
});

// Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de settings (las que ya tienes)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
  
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
  
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
  
    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});