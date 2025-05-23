<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Middlewares\AdminMiddleware;
use App\Http\Middlewares\FormateurMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('course');
// })->name('course');
// Route::get('/course', [FormationController::class, 'index'])
//     ->name('course');
Route::get('/', [FormationController::class, 'publicIndex'])->name('course');
Route::get('/course/{formation}', [FormationController::class, 'showPublic'])->name('course.show');


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/list', function () {
        return view('adminLayout/categories/list');
    })->name('list');
    
    Route::get('/souscategories', function () {
        return view('adminLayout/souscategories/scateg');
    })->name('souscategories');
    
  
    // Routes pour la gestion des utilisateurs
    Route::get('/admin/candidats', [LoginController::class, 'candidats'])->name('listcandidats');
    Route::get('/admin/formateurs', [LoginController::class, 'formateurs'])->name('listformateurs');
    Route::patch('/admin/users/{user}/toggle-block', [LoginController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::post('/admin/users/{user}/contact', [LoginController::class, 'contact'])->name('user.contact');


    Route::get('/scategories', [SousCategorieController::class, 'index']); 
     Route::post('/scategories', [SousCategorieController::class, 'store']); 
     Route::get('/scategories/{id}', [SousCategorieController::class, 'show']); 
     Route::put('/scategories/{id}', [SousCategorieController::class, 'update']); 
     Route::delete('/scategories/{id}', [SousCategorieController::class, 'destroy']);
});

//authentification
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// APRÈS (correct)
Route::get('/profiles/{profile}/cv_path', [ProfileController::class, 'downloadCv'])->name('profiles.cv_path.download');
Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profile');
Route::put('/profiles/{profile}/edit', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
// For downloading CV
Route::put('/profiles/{profile}/cv_path', [ProfileController::class, 'uploadCv'])
     ->name('profiles.cv_path.upload');


     
/*
Route::get('/formateurs', [FormationController::class, 'getFormateurs']);
Route::get('/souscategories', [FormationController::class, 'getSousCategories']);
//Route::get('/formations', [FormationController::class, 'index']);
*/

Route::get('/course', [FormationController::class, 'publicIndex'])->name('course.public');
// Route::get('/formations/{id}', [FormationController::class, 'show'])->name('formations.show');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
// routes/web.php
// Route pour afficher le quiz (GET)
Route::get('/formations/{formationId}/quiz', [QuizController::class, 'show'])
     ->name('quiz.show');

     Route::post('/quiz/{quizId}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
     Route::post('/quizzs', [QuizController::class, 'store']);
     Route::put('/quizzs/{id}', [QuizController::class, 'update']);
     Route::delete('/quizzs/{id}', [QuizController::class, 'destroy']);
     
     Route::post('/formations/{id}/quiz', [QuizController::class, 'store'])->name('formation.quiz.store');
     Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');

Route::get('/certificat/{quiz}', [CertificateController::class, 'showCertificateView'])
    ->name('certificat.show');

    Route::middleware(['auth'])->group(function () {
        Route::get('/formations/{id}', [FormationController::class, 'showPublic'])->name('formations.show');
    });

    Route::get('/formations/sous-categorie/{id}', [FormationController::class, 'showFormationsParSousCategorie'])->name('formations.souscategorie');
    Route::get('/courses', [FormationController::class, 'index'])->name('courses');
    Route::get('/courses', [App\Http\Controllers\FormationController::class, 'showcategorie'])->name('course');


    Route::middleware([FormateurMiddleware::class])->group(function () {

    Route::get('/formations', function () {
        return view('adminLayout/formations/formation');
    })->name('formations');
});