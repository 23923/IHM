<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'user_id',
        'quiz_id',
        'formation_id',
        'is_passed',
        'certif_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function certificat()
    {
        return $this->hasOne(Certificat::class, 'score_id');
    }
}