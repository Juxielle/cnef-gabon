<?php

use App\Http\Controllers\ActeurController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\AgrementController;
use App\Http\Controllers\AgrementDossierController;
use App\Http\Controllers\BarometreController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EtudeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LienUtileController;
use App\Http\Controllers\MediationController;
use App\Http\Controllers\VeilleController;
use Illuminate\Support\Facades\Route;

Route::get('/langue/{locale}', function (string $locale) {
    abort_unless(array_key_exists($locale, config('locales.supported', [])), 404);
    session(['locale' => $locale]);

    return redirect()->to(url()->previous());
})->where('locale', '[a-z]{2,5}(?:-[A-Z]{2})?')->name('locale.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/assistant/message', [ChatbotController::class, 'respond'])
    ->middleware('throttle:30,1')
    ->name('chatbot.respond');

Route::get('/acteurs', [ActeurController::class, 'index'])->name('acteurs.index');
Route::get('/agrements', [AgrementController::class, 'index'])->name('agrements.index');
Route::get('/suivi-agrement', [AgrementDossierController::class, 'index'])->name('agrement-dossiers.index');
Route::post('/suivi-agrement/depot', [AgrementDossierController::class, 'store'])->middleware('throttle:10,1')->name('agrement-dossiers.store');
Route::post('/suivi-agrement/recherche', [AgrementDossierController::class, 'track'])->middleware('throttle:30,1')->name('agrement-dossiers.track');
Route::get('/veille-reglementaire', [VeilleController::class, 'index'])->name('veille.index');
Route::get('/barometre-economique', [BarometreController::class, 'index'])->name('barometre.index');
Route::get('/etudes', [EtudeController::class, 'index'])->name('etudes.index');
Route::get('/education-financiere', [EducationController::class, 'index'])->name('education.index');
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/liens-utiles', [LienUtileController::class, 'index'])->name('liens.index');

// ── MÉDIATION FINANCIÈRE (PRÉSENTATION DU DISPOSITIF & REDIRECTION) ──
Route::get('/mediation-financiere', [MediationController::class, 'index'])->name('mediation.index');
Route::redirect('/mediation-financiere/{any}', '/mediation-financiere')->where('any', '.*');


