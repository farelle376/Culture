<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashbord1', function () {
    return view('dashbord1');
});

 Route::get('/acces', function () {
    return view('acces');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/deploy-webhook', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return response('Migrations exécutées');
})->middleware('auth.basic'); // Sécuriser avec Basic Auth
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/front.php';
