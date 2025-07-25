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
Schema::create('course_user', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->foreignId('course_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // أعمدة إضافية مفيدة:
    $table->integer('progress')->default(0); // نسبة التقدم (0-100)
    $table->boolean('completed')->default(false); // هل الكورس مكتمل؟
    $table->timestamp('started_at')->nullable(); // تاريخ بدء الكورس
    $table->timestamp('completed_at')->nullable(); // تاريخ إنهاء الكورس

    $table->timestamps();
});




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
