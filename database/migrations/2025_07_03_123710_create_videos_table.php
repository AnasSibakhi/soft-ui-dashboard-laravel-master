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
    Schema::create('videos', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('title');
      $table->text('link');
    $table->foreignId('course_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::table('videos', function (Blueprint $table) {
    $table->string('file')->nullable()->after('link');
});

    }
};
