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
   Schema::create('questions', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('title');
    $table->json('answers');
    $table->string('right_answer');
    $table->integer('score'); // أو float إذا بدك أرقام عشرية
    $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
