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
    // migration for photos table
Schema::create('photos', function (Blueprint $table) {
    $table->id();
    $table->string('filename');
    $table->unsignedBigInteger('photoable_id');
    $table->string('photoable_type'); // مثال: 'App\User' أو 'App\Course'
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
