<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Rating;
use App\Models\SousCategorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousCategorieId = request()->query('scategorie');
        
        $query = Formation::with(['formateur', 'sousCategorie']);
        
        if ($sousCategorieId) {
            $query->where('sous_categorie_id', $sousCategorieId);
        }
        
        return response()->json($query->get());
    }
    public function publicIndex(Request $request)
    {
        // Récupérer le niveau depuis la requête
        $niveau = $request->query('niveau');
        
        // Initialiser la requête
        $query = Formation::query();
        
        // Si un niveau est spécifié, filtrer
        if ($niveau) {
            // Liste des niveaux valides
            $niveauxValides = ['débutant', 'intermédiaire', 'avancé'];
            
            // Vérifier que le niveau demandé est valide
            if (in_array(strtolower($niveau), array_map('strtolower', $niveauxValides))) {
                $query->where('niveau', 'LIKE', $niveau);
            }
        }
        
        // Récupérer les formations
        $formations = $query->get();
        
        // Liste des niveaux pour le dropdown
        $niveaux = ['débutant', 'intermédiaire', 'avancé'];
        
        return view('course', compact('formations', 'niveaux'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'formateur_id' => 'required|exists:users,id',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'niveau' => 'required|in:débutant,intermédiaire,avancé',

        ]);

        $formation = Formation::create($validated);
        return response()->json($formation, 201);
    }
    public function getSousCategories()
    {
        $sousCategories = SousCategorie::select('id', 'nomscategorie')->get();
        return response()->json($sousCategories);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Charger la formation avec son formateur
        $formation = Formation::with('formateur')->findOrFail($id);
        $formateur = $formation->formateur;
    
        // Moyenne des notes pour cette formation spécifique
        $moyenneFormation = Rating::where('formation_id', $formation->id)->avg('note');
    
        // Nombre de notes pour cette formation
        $nombreRatingsFormation = Rating::where('formation_id', $formation->id)->count();
    
        // Moyenne des notes de toutes les formations du formateur
        $moyenneFormateur = Rating::whereIn('formation_id', $formateur->formations->pluck('id'))->avg('note');
    
        // Nombre total de notes sur toutes les formations du formateur
        $nombreRatings = Rating::whereIn('formation_id', $formateur->formations->pluck('id'))->count();
    
        return view('formation.show', [
            'formation' => $formation,
            'moyenneFormation' => $moyenneFormation,
            'nombreRatingsFormation' => $nombreRatingsFormation,
            'moyenneFormateur' => $moyenneFormateur,
            'nombreRatings' => $nombreRatings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->update($request->all());
        return response()->json($formation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return response()->json(['message' => 'Formation supprimée']);
    }
    public function getFormateurs()
{
    $formateurs = User::where('role', 'formateur')
                     ->select('id', 'name')
                     ->get();
    return response()->json($formateurs);
}

public function showPublic($id)
{
    $formation = Formation::with([
        'formateur' => function($query) {
            $query->withDefault([
                'name' => 'Formateur inconnu'
            ]);
        },
        'sousCategorie' => function($query) {
            $query->withDefault([
                'nomscategorie' => 'Non catégorisé'
            ]);
        }
    ])->findOrFail($id);

    return view('course-detail', compact('formation'));
}
public function showcategorie(Request $request)
{
    // Initialisation de la requête avec les relations
    $query = Formation::with(['formateur', 'sous_categorie.categorie'])
                ->whereHas('formateur')
                ->whereHas('sous_categorie');

    // Filtre par sous-catégorie
    if ($request->has('scategorie')) {
        $query->where('sous_categorie_id', $request->scategorie);
    }
    // Filtre par catégorie
    elseif ($request->has('categorie')) {
        $query->whereHas('sous_categorie', function($q) use ($request) {
            $q->where('categorieID', $request->categorie);
        });
    }

    // Filtre par niveau
    if ($request->filled('niveau')) {
        $query->where('niveau', 'like', '%'.$request->niveau.'%');
    }

    // Récupération des formations
    $formations = $query->get();

    // Niveaux disponibles
    $niveaux = Formation::select('niveau')
        ->whereNotNull('niveau')
        ->distinct()
        ->pluck('niveau')
        ->filter()
        ->values();

    // Récupération de la sous-catégorie si elle existe
    $sousCategorie = $request->has('scategorie') 
        ? SousCategorie::with('categorie')->find($request->scategorie) 
        : null;

    return view('course', compact('formations', 'niveaux', 'sousCategorie'));
}
}