<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $profile)
    {
        return view('adminLayout/profils/profile', compact('profile'));
    }

    public function edit(User $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, User $profile)
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->id !== $profile->id && !$user->isAdmin()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialite' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users,email,'.$profile->id,
            'role' => 'nullable|string',
            'competence' => 'nullable|array',
            'competence.*' => 'string|max:255',
         'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
     // Traitement des compétences
    if ($request->has('competence')) {
        // Filtrer les valeurs vides et supprimer les doublons
        $competences = array_unique(array_filter($request->input('competence')));
        $validated['competence'] = !empty($competences) ? implode(',', $competences) : null;
    } else {
        $validated['competence'] = null;
    }

        // Mise à jour des champs
        $profile->update($validated);
    
        // Gestion du fichier CV
        if ($request->hasFile('cv_path')) {
            // Supprimer l'ancien CV s'il existe
            if ($profile->cv_path && Storage::exists($profile->cv_path)) {
                Storage::delete($profile->cv_path);
            }
            
            // Stocker le nouveau CV
            $path = $request->file('cv_path')->store('public/cvs');
            $profile->cv_path = $path;
            $profile->save();
        }
    
        return redirect()->route('profile', $profile)
            ->with('success', 'Profil mis à jour avec succès');
    }

    public function destroy(User $profile)
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->id !== $profile->id && !$user->isAdmin()) {
            abort(403);
        }

        // Supprimer le CV s'il existe
        if ($profile->cv_path && Storage::exists($profile->cv_path)) {
            Storage::delete($profile->cv_path);
        }

        $profile->delete();

        return redirect()->route('home')
            ->with('success', 'Profil supprimé avec succès');
    }

    public function downloadCv(User $profile)
    {
        if (!$profile->cv_path || !Storage::exists($profile->cv_path)) {
            abort(404);
        }

        return Storage::download($profile->cv_path);
    }
    public function uploadCv(Request $request, User $profile)
{/** @var User $user */
    $user = Auth::user();
    if ($user->id !== $profile->id && !$user->hasRole('admin')) {
        abort(403, 'Action non autorisée');
    }
    $request->validate([
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Supprimer l'ancien CV s'il existe
    if ($profile->cv_path && Storage::exists($profile->cv_path)) {
        Storage::delete($profile->cv_path);
    }

    // Stocker le nouveau fichier
    $path = $request->file('cv')->store('public/cvs');
    $profile->cv_path = $path;
    $profile->save();

    return back()->with('success', 'CV mis à jour avec succès');
}
// Méthode pour ajouter une compétence
public function addCompetence(Request $request, User $profile)
{
    /** @var User $user */
    $user = Auth::user();

    if ($user->id !== $profile->id && !$user->isAdmin()) {
        abort(403);
    }

    // Validation de la nouvelle compétence
    $validated = $request->validate([
        'competence' => 'required|string|max:255',
    ]);

    // Ajouter la compétence à la liste actuelle des compétences
    $competences = $profile->competence ? explode(',', $profile->competence) : [];
    
    // Éviter d'ajouter une compétence en double
    if (!in_array($validated['competence'], $competences)) {
        $competences[] = $validated['competence'];
    }

    // Mettre à jour le profil avec les nouvelles compétences
    $profile->competence = implode(',', $competences);
    $profile->save();

    return back()->with('success', 'Compétence ajoutée avec succès.');
}

// Méthode pour supprimer une compétence
public function deleteCompetence(Request $request, User $profile, $competenceIndex)
{
    /** @var User $user */
    $user = Auth::user();

    if ($user->id !== $profile->id && !$user->isAdmin()) {
        abort(403);
    }

    // Récupérer les compétences actuelles sous forme de tableau
    $competences = explode(',', $profile->competence);

    // Vérifier si l'indice est valide
    if (isset($competences[$competenceIndex])) {
        // Supprimer la compétence à l'indice donné
        unset($competences[$competenceIndex]);

        // Réindexer le tableau
        $competences = array_values($competences);

        // Convertir le tableau en une chaîne pour mettre à jour la base de données
        $profile->competence = implode(',', $competences);
        $profile->save();

        return back()->with('success', 'Compétence supprimée avec succès.');
    }

    return back()->with('error', 'Compétence non trouvée.');
}


}