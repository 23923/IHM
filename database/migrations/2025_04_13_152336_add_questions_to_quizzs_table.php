<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            // Ajoutez ces nouveaux champs
            $table->json('questions')->nullable()->after('title');
            $table->integer('time_limit')->default(30)->after('questions');
            $table->integer('passing_score')->default(70)->after('time_limit');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            // Pour annuler les modifications
            $table->dropColumn(['questions', 'time_limit', 'passing_score']);
        });
    }
};
