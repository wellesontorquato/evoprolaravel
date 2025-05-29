<?php

use Illuminate\Support\Facades\Route;
use App\Models\Modelo;
use App\Http\Controllers\{
    ProfileController,
    EvolucaoController,
    ModeloController,
    DashboardController
};

// Página pública
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

// Dashboard (autenticado e verificado)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rotas protegidas
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil do Usuário
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Evoluções
    |--------------------------------------------------------------------------
    */
    Route::prefix('evolucoes')->name('evolucoes.')->group(function () {
        Route::get('/', [EvolucaoController::class, 'index'])->name('index');
        Route::get('/nova', [EvolucaoController::class, 'create'])->name('create');
        Route::post('/', [EvolucaoController::class, 'store'])->name('store');
        Route::delete('/{evolucao}', [EvolucaoController::class, 'destroy'])->name('destroy');
        Route::get('/exportar/pdf', [EvolucaoController::class, 'exportarPdf'])->name('exportar.pdf');
        Route::get('/{evolucao}/pdf', [EvolucaoController::class, 'exportarPdfUnico'])->name('exportar.pdf.unico');
    });

    // Resultado de uma evolução gerada
    Route::get('/resultado/{id}', [EvolucaoController::class, 'resultado'])->name('evolucoes.resultado');

    /*
    |--------------------------------------------------------------------------
    | Modelos Personalizados
    |--------------------------------------------------------------------------
    */
    Route::prefix('modelos')->name('modelos.')->group(function () {
        Route::get('/', [ModeloController::class, 'index'])->name('index');
        Route::post('/', [ModeloController::class, 'store'])->name('store');
        Route::put('/{modelo}', [ModeloController::class, 'update'])->name('update');
        Route::delete('/{modelo}', [ModeloController::class, 'destroy'])->name('destroy');
    });

    Route::get('/modelo/{modelo}/placeholders', [ModeloController::class, 'placeholders'])
    ->name('modelos.placeholders');
});

require __DIR__ . '/auth.php';
