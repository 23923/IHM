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
        Schema::table('certificats', function (Blueprint $table) {
            $table->dropColumn(['score', 'is_passed']); // Supprimez les champs en double
            $table->foreignId('score_id')->constrained('scores')->after('quiz_id');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
