<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
       'name', 'email', 'password', 'role', 
        'specialite', 'competence', 'cv_path'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    public function isFormateur(): bool
    {
        return $this->role === 'formateur';
    }
    
    public function isCandidat(): bool
    {
        return $this->role === 'candidat';
    }
    public function ratings() {
        return $this->hasMany(Rating::class);
    }
    public function formations()
    {
        return $this->hasMany(Formation::class, 'formateur_id');
    }

public function quizzs()
{
    return $this->belongsToMany(Quiz::class)->withPivot('score')->withTimestamps();
}
public function scores()
{
    return $this->hasMany(Score::class);
}

public function certificats()
{
    return $this->hasMany(Certificat::class);
}

}
