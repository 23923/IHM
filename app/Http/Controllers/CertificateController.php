<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function showCertificateView(Quiz $quiz)
    {
        // 1. Récupération de l'utilisateur connecté
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Utilisateur non connecté.');
        }



        $formation = $quiz->formation;

        if (!$formation) {
            abort(404, 'Formation associée à ce quiz introuvable.');
        }

        // 4. Affichage de la vue certificat avec les données
        return view('certificat', [
            'user'      => $user,
            'formation' => $formation,
            'quiz'      => $quiz,
        ]);
    }
}