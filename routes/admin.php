<?php

use App\Http\Controllers\Admin\ActeurController;
use App\Http\Controllers\Admin\AgrementDossierController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BaroKpiController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EtudeController;
use App\Http\Controllers\Admin\LienUtileController;
use App\Http\Controllers\Admin\MediateurCandidatureController;
use App\Http\Controllers\Admin\MediationKpiController;
use App\Http\Controllers\Admin\MediationLitigeController;
use App\Http\Controllers\Admin\MediationRequestController;
use App\Http\Controllers\Admin\MediationSaisineTrimestreController;
use App\Http\Controllers\Admin\SecteurEconomiqueController;
use App\Http\Controllers\Admin\TexteReglementaireController;
use App\Http\Controllers\Admin\VeilleInnovationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // ── Authentification (accessible sans être connecté) ──
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Back-office protégé ──
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('acteurs', ActeurController::class)->except(['show']);
        Route::resource('textes', TexteReglementaireController::class)->except(['show']);
        Route::resource('etudes', EtudeController::class)->except(['show']);
        Route::resource('actualites', ActualiteController::class)->except(['show']);
        Route::resource('veille-innovations', VeilleInnovationController::class)->except(['show']);
        Route::resource('liens', LienUtileController::class)->except(['show']);
        Route::resource('secteurs', SecteurEconomiqueController::class)->except(['show']);
        Route::resource('baro-kpis', BaroKpiController::class)->except(['show']);
        Route::resource('mediation-kpis', MediationKpiController::class)->except(['show']);
        Route::resource('mediation-litiges', MediationLitigeController::class)->except(['show']);
        Route::resource('mediation-saisines', MediationSaisineTrimestreController::class)->except(['show']);

        foreach ([
            'mediation-requests' => MediationRequestController::class,
            'messages' => ContactMessageController::class,
            'candidatures' => MediateurCandidatureController::class,
            'agrement-dossiers' => AgrementDossierController::class,
        ] as $prefix => $controller) {
            Route::get($prefix, [$controller, 'index'])->name($prefix.'.index');
            Route::get($prefix.'/{id}', [$controller, 'show'])->name($prefix.'.show');
            Route::patch($prefix.'/{id}/status', [$controller, 'updateStatus'])->name($prefix.'.status');
            Route::delete($prefix.'/{id}', [$controller, 'destroy'])->name($prefix.'.destroy');
            Route::get($prefix.'/{id}/pieces/{index}', [$controller, 'download'])->name($prefix.'.download');
        }
    });
});
