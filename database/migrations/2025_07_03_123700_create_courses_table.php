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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description' , 500  );
            $table->string('slug', 500)->nullable();
            $table->integer('status')->default(0); // تم التعديل من text إلى integer
            $table->string('link');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable(); // إذا كنت سترفع صورة للكورس
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
