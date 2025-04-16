<?php
namespace App\Http\Controllers;

use App\Models\Certificat;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Quiz;
use App\Models\Score;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class QuizController extends Controller
{
    public function show($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        
        // Créer automatiquement un quiz basé sur les détails de la formation
        $quiz = Quiz::firstOrCreate(
            ['formation_id' => $formationId],
            [
                'title' => 'Quiz pour '.$formation->titre,
                'passing_score' => 70,
                'questions' => $this->generateQuestionsFromFormation($formation)
            ]
        );
        
        return view('quiz', compact('quiz', 'formation'));
    }

    private function generateQuestionsFromFormation(Formation $formation)
    {
        $questions = [];
        
        // Question 1: Sur le titre de la formation
        $questions[] = [
            'question' => "Quel est le titre de cette formation?",
            'type' => 'multiple',
            'points' => 1,
            'options' => [
                ['text' => $formation->titre, 'correct' => true],
                ['text' => $this->generateWrongAnswer($formation->titre), 'correct' => false],
                ['text' => $this->generateWrongAnswer($formation->titre), 'correct' => false],
                ['text' => $this->generateWrongAnswer($formation->titre), 'correct' => false]
            ]
        ];
        
        // Question 2: Sur le formateur
        if ($formation->formateur) {
            $questions[] = [
                'question' => "Qui est le formateur de cette formation?",
                'type' => 'multiple',
                'points' => 1,
                'options' => [
                    ['text' => $formation->formateur->name, 'correct' => true],
                    ['text' => $this->generateWrongAnswer($formation->formateur->name), 'correct' => false],
                    ['text' => $this->generateWrongAnswer($formation->formateur->name), 'correct' => false],
                    ['text' => "Aucun formateur", 'correct' => false]
                ]
            ];
        }
        
        // Question 3: Sur la description (vrai/faux)
        if ($formation->description) {
            $questions[] = [
                'question' => "La description contient '".$this->extractKeyPhrase($formation->description)."'?",
                'type' => 'true_false',
                'points' => 1,
                'correct_answer' => true
            ];
        }
        
        // Question 4: Sur la catégorie
        if ($formation->sousCategorie) {
            $questions[] = [
                'question' => "À quelle catégorie appartient cette formation?",
                'type' => 'multiple',
                'points' => 1,
                'options' => [
                    ['text' => $formation->sousCategorie->nomscategorie, 'correct' => true],
                    ['text' => $this->generateWrongAnswer($formation->sousCategorie->nomscategorie), 'correct' => false],
                    ['text' => $this->generateWrongAnswer($formation->sousCategorie->nomscategorie), 'correct' => false],
                    ['text' => "Autre", 'correct' => false]
                ]
            ];
        }
        
        // Ajoutez d'autres questions basées sur les attributs de la formation
        
        return $questions;
    }
    
    private function generateWrongAnswer($correctAnswer)
    {
        // Logique simple pour générer des réponses incorrectes plausibles
        if (strlen($correctAnswer) > 10) {
            return substr($correctAnswer, 0, -3) . "XYZ";
        }
        return $correctAnswer . " (incorrect)";
    }
    
    private function extractKeyPhrase($text)
    {
        // Extrait une phrase clé de la description
        $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $text);
        return trim($sentences[0] ?? "certaines informations");
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'formation_id' => 'required|exists:formations,id',
                'title' => 'required|string|max:255',
                'passing_score' => 'required|integer|min:0|max:100',
                'questions' => 'required|array|min:1',
                'questions.*.question' => 'required|string',
                'questions.*.type' => 'required|in:multiple,true_false',
                'questions.*.points' => 'required|integer|min:1',
                'questions.*.options' => 'required_if:questions.*.type,multiple|array',
                'questions.*.options.*.text' => 'required_if:questions.*.type,multiple|string',
                'questions.*.options.*.correct' => 'required_if:questions.*.type,multiple|boolean',
                'questions.*.correct_answer' => 'required_if:questions.*.type,true_false|boolean',
            ]);
    
            $quiz = Quiz::create([
                'formation_id' => $validated['formation_id'],
                'title' => $validated['title'],
                'passing_score' => $validated['passing_score'],
                'questions' => $validated['questions']
            ]);
    
            return response()->json([
                'message' => 'Quiz créé avec succès', 
                'quiz' => $quiz
            ], 201);
        } catch (\Exception $e) {
           
            return response()->json([
                'error' => 'Failed to create quiz',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Update the specified quiz in storage.
     */
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'passing_score' => 'sometimes|required|integer|min:0|max:100',
            'questions' => 'sometimes|required|array',
        ]);

       
        $quiz->update($request->only(['title', 'passing_score', 'questions']));

        return response()->json(['message' => 'Quiz mis à jour avec succès', 'quiz' => $quiz]);
    }

    /**
     * Remove the specified quiz from storage.
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return response()->json(['message' => 'Quiz supprimé avec succès']);
    }
    public function submit(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $user = Auth::user();
        $answers = $request->input('answers', []);
        $score = 0;
        $totalPoints = 0;
    
        foreach ($quiz->questions as $index => $question) {
            $questionPoints = $question['points'] ?? 1;
            $totalPoints += $questionPoints;
    
            if ($question['type'] === 'multiple') {
                $correctOptionIndex = collect($question['options'])->search(fn($opt) => $opt['correct']);
                if ((int)$answers[$index] === $correctOptionIndex) {
                    $score += $questionPoints;
                }
            } elseif ($question['type'] === 'true_false') {
                $correctAnswer = $question['correct_answer'] ? 1 : 0;
                if ((int)$answers[$index] === $correctAnswer) {
                    $score += $questionPoints;
                }
            }
        }
    
        $percentage = round(($totalPoints > 0) ? ($score / $totalPoints) * 100 : 0, 2);
        $isPassed = $percentage >= $quiz->passing_score;
    
        // Créer le score d'abord
        $scoreRecord = Score::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'formation_id' => $quiz->formation_id, // Ajouté pour cohérence
            'score' => $percentage,
            'is_passed' => $isPassed,
        ]);
    
        // Créer le certificat seulement si réussi
        $certificat = null;
        if ($isPassed) {
            $certificat = Certificat::create([
                'user_id' => $user->id,
                'formation_id' => $quiz->formation_id,
                'quiz_id' => $quiz->id,
                'score_id' => $scoreRecord->id,
                'code_certificat' => 'CERT-' . strtoupper(uniqid()),
                'date_obtention' => now(),
            ]);
    
            // Mettre à jour le score avec l'ID du certificat
            $scoreRecord->update(['certif_id' => $certificat->id]);
        }
    
        return view($isPassed ? 'success' : 'failed', [
            'quiz' => $quiz,
            'score' => $percentage,
            'certificat' => $certificat
        ]);
    }
    
  
// QuizController.php
// QuizController.php
}