<?php
use App\Http\Controllers\Auth\InscritController;
use App\Http\Controllers\FrontsController;
use App\Http\Controllers\GuestPaymentController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\InscriptionsController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\PayementsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

//Route contoller Inscription
Route::get('/inscription', [InscriptionsController::class, 'showRegisterForm'])
    ->name('front.inscription');

Route::post('/inscription', [InscriptionsController::class, 'register'])
    ->name('front.inscription.store');

Route::get('/', [InscriptionsController::class, 'index'])
    ->name('front.front');

Route::post('/inscrit', [InscriptionsController::class, 'inscrits'])
    ->name('front.inscrit');    

Route::get('/apropos', [InscriptionsController::class, 'propos'])
    ->name('front.apropos');       

// Route controller UserProfile    
Route::get('/userprofile', [UserProfileController::class, 'index'])
    ->name('front.profile');
Route::get('/modifier-profil', [UserProfileController::class, 'edit'])
    ->name('modifier');
Route::put('/profil/modifier', [UserProfileController::class, 'update'])->name('modifier.update');

//Route controller Users    
Route::get('/mon-espace', [UsersController::class, 'index'])
    ->name('front.users');

Route::get('/check-tables', [UsersController::class, 'checkTables'])
    ->middleware('auth')
    ->name('check.tables');

 Route::get('/contenus/ajouter', [UsersController::class, 'ajouterContenu'])->name('ajouter-contenu');
    Route::post('/contenus/store', [UsersController::class, 'storeContenu'])->name('store-contenu');
    Route::get('/contenus/parent', [UsersController::class, 'getParentContenus'])->name('parent-contenus');
    Route::get('/mes-contenus', [UsersController::class, 'mesContenu'])->name('mes-contenus');
    Route::get('/contenu/{id}/voir', [UsersController::class, 'voirContenu'])->name('voir-contenu');
    Route::get('/contenu/{id}/editer', [UsersController::class, 'editerContenu'])->name('editer-contenu');
    Route::get('/contenu/{id}/supprimer', [UsersController::class, 'supprimerContenu'])->name('supprimer-contenu');
    // API pour les contenus parents
    Route::get('/api/contenus-parent', [UsersController::class, 'getParentContenus'])->name('api.parent-contenus');
    Route::get('/categorie/{category}', [UsersController::class, 'filterByCategory'])->name('category');

// Détail d'un contenu
Route::get('/contenu/{id}', [UsersController::class, 'show'])->name('contenu.show');

//Route controller Inscrit
Route::get('/inscrit', [InscritController::class, 'create'])
        ->name('inscrit');
Route::post('/connection', [InscritController::class, 'connection'])
        ->name('inscrite');
Route::post('/logout', [InscritController::class, 'logoute'])
        ->name('logoute');

//Route contoller Region
Route::get('/regions', [RegionController::class, 'index'])->name('region');
Route::get('/regions/{id}', [RegionController::class, 'show'])->name('regionshow'); 

//Route controller Langue
// Routes pour les langues
Route::get('/langues', [LangueController::class, 'index'])->name('langue');
Route::get('/langues/{id}', [LangueController::class, 'show'])->name('langueshow');

// Filtrage par catégorie

    Route::get('/payment/{order}', [PaymentController::class, 'showPaymentForm'])
        ->name('payment.form');
    
    // Initier le paiement
    Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])
        ->name('payment.initiate');
    
    // Callback après paiement
    Route::get('/payment/callback', [PaymentController::class, 'callback'])
        ->name('payment.callback');

// Webhook (sans authentification et sans CSRF)
Route::post('/api/fedapay/webhook', [PaymentController::class, 'webhook'])
    ->name('payment.webhook');
    

// Route de test (à désactiver en production)
if (app()->environment('local')) {
    Route::get('/test-fedapay', [PaymentController::class, 'testConnection']);
}