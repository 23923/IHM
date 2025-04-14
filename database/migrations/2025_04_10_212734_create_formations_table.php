<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('image');
            $table->foreignId('formateur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sous_categorie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->enum('niveau', ['débutant', 'intermédiaire', 'avancé'])->default('débutant');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
