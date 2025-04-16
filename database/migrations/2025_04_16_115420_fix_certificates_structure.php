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
            if (!Schema::hasColumn('certificats', 'score_id')) {
                $table->unsignedBigInteger('score_id')->nullable(false);
            }
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
