<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('quiz_user_answers', function (Blueprint $table) {
        $table->id();

        // المستخدم
        $table->unsignedBigInteger('user_id');

        // الكويز
        $table->unsignedBigInteger('quiz_id');

        // هل الإجابة صحيحة؟
        $table->boolean('is_correct')->default(false);

        // تخزين جميع الإجابات (اختياري)
        $table->json('answers')->nullable();

        // العلامة (اختياري)
        $table->integer('score')->nullable();

        $table->timestamps();

        // foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('quiz_user_answers');
}

};
