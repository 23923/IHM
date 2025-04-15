<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'image',
        'formateur_id',     
        'sous_categorie_id', 
        'niveau'
    ];
    protected $casts = [
        'niveau' => 'string'
    ];

    // Relation avec le formateur (User)
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    //  Relation avec la sous-catégorie
    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, "sous_categorie_id");
    }
    public function ratings() {
    return $this->hasMany(Rating::class);
}

public function averageRating() {
    return $this->ratings()->avg('rating');
}

public function quiz()
{
    return $this->hasOne(Quiz::class);
}
public function generateQuiz()
{
    $quiz = new Quiz();
    $quiz->question = "Qu'avez-vous appris dans la formation '".$this->titre."'?";
    $quiz->time_quiz = 10; // 10 minutes par défaut
    $quiz->note = 12; // Note minimale pour réussir
    $this->quizzs()->save($quiz);
    
    return $quiz;
}
public function sous_categorie()
{
    return $this->belongsTo(SousCategorie::class, 'sous_categorie_id');
}




// Dans le modèle SousCategorie
public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categorieID');
}

public function formations()
{
    return $this->hasMany(Formation::class, 'sous_categorie_id');
}

// Dans le modèle Categorie
public function scategories()
{
    return $this->hasMany(SousCategorie::class, 'categorieID');
}
}