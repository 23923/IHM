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

        if (!Auth::check()) {
            return back()->with('error', 'Vous devez être connecté pour noter une formation.');
        }

        $user = Auth::user();

        if ($user->role !== 'candidat') {
            return back()->with('error', 'Seuls les candidats peuvent noter les formations.');
        }

        Rating::updateOrCreate(
            [
                'user_id' => $user->id,
                'formation_id' => $request->formation_id
            ],
            [
                'note' => $request->note
            ]
        );

        return back()->with('success', "Votre note a été enregistrée !");
    }

    public function show(Formation $formation)
    {
        $averageRating = number_format($formation->ratings->avg('note') ?? 0, 1);
        
        $userRating = null;
        if (Auth::check()) {
            $userRating = Rating::where('user_id', Auth::id())
                               ->where('formation_id', $formation->id)
                               ->first();
        }

        return view('formations.show', compact('formation', 'averageRating', 'userRating'));
    }
}