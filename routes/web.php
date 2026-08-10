<?php

use App\Http\Controllers\ActeurController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\AgrementController;
use App\Http\Controllers\BarometreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EtudeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LienUtileController;
use App\Http\Controllers\MediationController;
use App\Http\Controllers\VeilleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/acteurs', [ActeurController::class, 'index'])->name('acteurs.index');
Route::get('/agrements', [AgrementController::class, 'index'])->name('agrements.index');
Route::get('/veille-reglementaire', [VeilleController::class, 'index'])->name('veille.index');
Route::get('/barometre-economique', [BarometreController::class, 'index'])->name('barometre.index');
Route::get('/etudes', [EtudeController::class, 'index'])->name('etudes.index');
Route::get('/education-financiere', [EducationController::class, 'index'])->name('education.index');
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/liens-utiles', [LienUtileController::class, 'index'])->name('liens.index');

Route::get('/mediation-financiere', [MediationController::class, 'index'])->name('mediation.index');
Route::post('/mediation-financiere/saisine', [MediationController::class, 'storeSaisine'])->name('mediation.saisine.store');
Route::post('/mediation-financiere/candidature', [MediationController::class, 'storeCandidature'])->name('mediation.candidature.store');
