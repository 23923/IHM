<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'score',
        'user_id',
        'quiz_id',
        'formation_id' // Optionnel si vous voulez aussi lier directement à la formation
    ];

    /**
     * Relation avec le modèle User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Relation optionnelle avec le modèle Formation
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Scope pour les scores réussis (supérieurs au score de passage)
     */
    public function scopePassed($query, $passingScore = 70)
    {
        return $query->where('score', '>=', $passingScore);
    }

    /**
     * Scope pour les scores d'un utilisateur spécifique
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Accesseur pour le score formaté
     */
    public function getFormattedScoreAttribute()
    {
        return $this->score.'%';
    }

    /**
     * Vérifie si le score est réussi
     */
    public function isPassing($passingScore = 70)
    {
        return $this->score >= $passingScore;
    }
}