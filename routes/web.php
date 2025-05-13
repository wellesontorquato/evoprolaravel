<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvolucaoController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');

// Rota padrão da dashboard (pode ser uma view simples ou redirecionada no controller)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🔒 Todas as rotas internas protegidas por auth + verificação de e-mail
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Evoluções
    Route::get('/evolucoes', [EvolucaoController::class, 'index'])->name('evolucoes.index');
    Route::get('/evolucoes/nova', [EvolucaoController::class, 'create'])->name('evolucoes.create');
    Route::post('/evolucoes', [EvolucaoController::class, 'store'])->name('evolucoes.store');
    Route::delete('/evolucoes/{evolucao}', [EvolucaoController::class, 'destroy'])->name('evolucoes.destroy');
    Route::get('/evolucoes/exportar/pdf', [EvolucaoController::class, 'exportarPdf'])->name('evolucoes.exportar.pdf');
    Route::get('/resultado/{id}', [EvolucaoController::class, 'resultado'])->name('evolucoes.resultado');
    Route::get('/evolucoes/{evolucao}/pdf', [EvolucaoController::class, 'exportarPdfUnico'])
        ->name('evolucoes.exportar.pdf.unico');

    // Modelos
    Route::get('/modelos', [ModeloController::class, 'index'])->name('modelos.index');
    Route::post('/modelos', [ModeloController::class, 'store'])->name('modelos.store');
    Route::put('/modelos/{modelo}', [ModeloController::class, 'update'])->name('modelos.update');
    Route::delete('/modelos/{modelo}', [ModeloController::class, 'destroy'])->name('modelos.destroy');
});

require __DIR__.'/auth.php';
