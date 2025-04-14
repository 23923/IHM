<?php
namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


    
    class RatingController extends Controller
    {
        public function store(Request $request)
        {
            $request->validate([
                'formation_id' => 'required|exists:formations,id',
                'note' => 'required|integer|min:1|max:5',
            ]);
    
            $user = Auth::user();
    
            if ($user->role !== 'candidat') {
                return back()->with('error', 'Seuls les candidats peuvent noter les formations.');
            }
    
            $formation = Formation::find($request->formation_id);
    
            // Vérifier si l'utilisateur a déjà noté cette formation
            $userRating = Rating::where('user_id', $user->id)
                                ->where('formation_id', $formation->id)
                                ->first();
    
            if ($userRating) {
                $userRating->update(['note' => $request->note]);
            } else {
                Rating::create([
                    'user_id' => $user->id,
                    'formation_id' => $formation->id,
                    'note' => $request->note,
                ]);
            }
    
            return back()->with('success', "Merci d'avoir noté la formation '{$formation->titre}' !");
        }
    
        public function show(Formation $formation)
        {
            $averageRating = number_format($formation->ratings->avg('note') ?? 0, 1);
    
            return view('formations.show', compact('formation', 'averageRating'));
        }
    }
    

