<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SousCategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);
    Route::resource('souscategories', SousCategorieController::class);
    Route::resource('formations', FormationController::class); 

    Route::get('/formateurs', [FormationController::class, 'getFormateurs']);
    Route::get('/souscategories-list', [SousCategorieController::class, 'list']);
    Route::get('/souscategories', [FormationController::class, 'getSousCategories']);
Route::post('/scategories', [SousCategorieController::class, 'store']);

Route::apiResource('scategories', SousCategorieController::class);
// routes/api.php
Route::post('/quizzs', [QuizController::class, 'store']);
Route::get('/api/certificat/{quiz}', [QuizController::class, 'showCertificateJson']);

});