<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomscategorie','categorieID'
        ];
        public function categorie()
        {
        return $this->belongsTo(Categorie::class,"categorieID");
        }
    // Relation avec les formations
        public function formations()
        {
            return $this->hasMany(Formation::class, 'sous_categorie_id');
        }
    }