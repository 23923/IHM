<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{ 
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'quiz_id',
        'score_id', // Changé de 'score' à 'score_id'
        'date_obtention',
        'code_certificat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}