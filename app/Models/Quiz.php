<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzs';

    protected $fillable = [
        'formation_id',
        'title',
        'questions', // Stocke toutes les questions en JSON
        'time_limit',
        'passing_score'
    ];

    protected $casts = [
        'questions' => 'array',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user')->withPivot('score', 'completed_at');
    }    
   
}