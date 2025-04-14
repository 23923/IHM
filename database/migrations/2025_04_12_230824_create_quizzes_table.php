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
        Schema::create('quizzs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formation_id'); // Changed from id_formation to formation_id
            $table->string('title');
            $table->timestamps();
        
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzs');
    }
};
