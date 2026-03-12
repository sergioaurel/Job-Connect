<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\Candidat\DashboardController as CandidatDashboardController;
use App\Http\Controllers\Candidat\ProfilController;
use App\Http\Controllers\Entreprise\DashboardController as EntrepriseDashboardController;
use App\Http\Controllers\Entreprise\OffreEntrepriseController;
use App\Http\Controllers\Entreprise\CandidatureEntrepriseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EntrepriseController as AdminEntrepriseController;
use App\Http\Controllers\Admin\StatistiqueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages institutionnelles
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Offres publiques
Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
Route::get('/offres/{slug}', [OffreController::class, 'show'])->name('offres.show');
Route::get('/categorie/{slug}', [OffreController::class, 'categorie'])->name('offres.categorie');

/*
|--------------------------------------------------------------------------
| Routes Authentification (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes Candidat (Protégées par middleware 'auth' et 'candidat')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'candidat'])->prefix('candidat')->name('candidat.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [CandidatDashboardController::class, 'index'])->name('dashboard');
    
    // Mes candidatures
    Route::get('/candidatures', [CandidatDashboardController::class, 'candidatures'])->name('candidatures');
    
    // Mes favoris
    Route::get('/favoris', [CandidatDashboardController::class, 'favoris'])->name('favoris');
    
    // Gestion du profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/infos', [ProfilController::class, 'updateInfos'])->name('profil.update-infos');
    
    // Expériences
    Route::post('/profil/experiences', [ProfilController::class, 'addExperience'])->name('profil.add-experience');
    Route::delete('/profil/experiences/{id}', [ProfilController::class, 'deleteExperience'])->name('profil.delete-experience');
    
    // Formations
    Route::post('/profil/formations', [ProfilController::class, 'addFormation'])->name('profil.add-formation');
    Route::delete('/profil/formations/{id}', [ProfilController::class, 'deleteFormation'])->name('profil.delete-formation');
    
    // Compétences
    Route::post('/profil/competences', [ProfilController::class, 'addCompetence'])->name('profil.add-competence');
    Route::delete('/profil/competences/{id}', [ProfilController::class, 'deleteCompetence'])->name('profil.delete-competence');
    
    // Candidatures
    Route::get('/postuler/{offre}', [CandidatureController::class, 'create'])->name('candidatures.create');
    Route::post('/postuler/{offre}', [CandidatureController::class, 'store'])->name('candidatures.store');
    
    // Favoris (AJAX)
    Route::post('/favoris/toggle/{offre}', [CandidatureController::class, 'toggleFavori'])->name('favoris.toggle');
});

/*
|--------------------------------------------------------------------------
| Routes Entreprise (Protégées par middleware 'auth' et 'entreprise')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'entreprise'])->prefix('entreprise')->name('entreprise.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [EntrepriseDashboardController::class, 'index'])->name('dashboard');
    
    // Profil entreprise
    Route::get('/profil/creer', [EntrepriseDashboardController::class, 'createProfil'])->name('profil.create');
    Route::post('/profil/creer', [EntrepriseDashboardController::class, 'storeProfil'])->name('profil.store');
    Route::get('/profil/modifier', [EntrepriseDashboardController::class, 'editProfil'])->name('profil.edit');
    Route::put('/profil/modifier', [EntrepriseDashboardController::class, 'updateProfil'])->name('profil.update');
    
    // Gestion des offres
    Route::get('/offres', [OffreEntrepriseController::class, 'index'])->name('offres.index');
    Route::get('/offres/creer', [OffreEntrepriseController::class, 'create'])->name('offres.create');
    Route::post('/offres/creer', [OffreEntrepriseController::class, 'store'])->name('offres.store');
    Route::get('/offres/{id}', [OffreEntrepriseController::class, 'show'])->name('offres.show');
    Route::get('/offres/{id}/modifier', [OffreEntrepriseController::class, 'edit'])->name('offres.edit');
    Route::put('/offres/{id}/modifier', [OffreEntrepriseController::class, 'update'])->name('offres.update');
    Route::patch('/offres/{id}/statut', [OffreEntrepriseController::class, 'changeStatus'])->name('offres.change-status');
    Route::delete('/offres/{id}', [OffreEntrepriseController::class, 'destroy'])->name('offres.destroy');
    
    // Gestion des candidatures reçues
    Route::get('/candidatures', [CandidatureEntrepriseController::class, 'index'])->name('candidatures.index');
    Route::get('/candidatures/offre/{offre}', [CandidatureEntrepriseController::class, 'offreCandidatures'])->name('candidatures.offre');
    Route::get('/candidatures/{id}', [CandidatureEntrepriseController::class, 'show'])->name('candidatures.show');
    Route::patch('/candidatures/{id}/statut', [CandidatureEntrepriseController::class, 'changeStatus'])->name('candidatures.change-status');
    Route::get('/candidatures/{id}/cv', [CandidatureEntrepriseController::class, 'downloadCV'])->name('candidatures.download-cv');
});

/*
|--------------------------------------------------------------------------
| Routes Admin (Protégées par middleware 'auth' et 'admin')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des entreprises
    Route::get('/entreprises', [AdminEntrepriseController::class, 'index'])->name('entreprises.index');
    Route::get('/entreprises/{id}', [AdminEntrepriseController::class, 'show'])->name('entreprises.show');
    Route::patch('/entreprises/{id}/valider', [AdminEntrepriseController::class, 'valider'])->name('entreprises.valider');
    Route::patch('/entreprises/{id}/rejeter', [AdminEntrepriseController::class, 'rejeter'])->name('entreprises.rejeter');
    Route::patch('/entreprises/{id}/suspendre', [AdminEntrepriseController::class, 'suspendre'])->name('entreprises.suspendre');
    Route::patch('/entreprises/{id}/reactiver', [AdminEntrepriseController::class, 'reactiver'])->name('entreprises.reactiver');
    
    // Statistiques
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques');
});

/*
|--------------------------------------------------------------------------
| Redirection selon le rôle après connexion
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isEntreprise()) {
        return redirect()->route('entreprise.dashboard');
    } elseif ($user->isCandidat()) {
        return redirect()->route('candidat.dashboard');
    }
    
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');