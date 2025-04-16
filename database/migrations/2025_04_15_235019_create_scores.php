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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            
            // Ajoutez d'abord les colonnes
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('certif_id');
            
            $table->timestamps();
            
            // Ajoutez ensuite les contraintes
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('quiz_id')
                  ->references('id')
                  ->on('quizzs') // Assurez-vous que le nom de la table est correct (quizzes ou quizzs)
                  ->onDelete('cascade');
                  
            $table->foreign('certif_id')
                  ->references('id')
                  ->on('certificats')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};