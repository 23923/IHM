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
        'score',
        'is_passed',
        'date_obtention',
        'code_certificat'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificat) {
            $certificat->code_certificat = 'CERT-' . strtoupper(uniqid());
        });
    }

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
}