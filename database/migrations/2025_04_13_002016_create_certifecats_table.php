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
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('formation_id');
            $table->unsignedBigInteger('quiz_id');
            $table->float('score');
            $table->boolean('is_passed');
            $table->date('date_obtention')->default(now());
            $table->string('code_certificat')->unique();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzs')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifecats');
    }
};
