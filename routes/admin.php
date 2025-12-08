<?php

use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\ProfilsController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TypeContenusController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\TypeMediasController;
use App\Http\Controllers\UtilisateursController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware('admin')->group(function(){
    Route::resource('langues',LanguesController::class);
    Route::resource('utilisateurs',UtilisateursController::class);
    Route::resource('contenus',ContenusController::class);
    Route::resource('regions',RegionsController::class);
    Route::resource('medias',MediasController::class);
    Route::resource('roles',RolesController::class);
    Route::resource('typeContenus',TypeContenusController::class);
    Route::resource('typeMedias',TypeMediasController::class);
    Route::resource('commentaires',CommentairesController::class);
    Route::resource('profils',ProfilsController::class);
   


});



