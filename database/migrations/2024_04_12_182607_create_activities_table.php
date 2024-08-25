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
        Schema::create('activities', function (Blueprint $table) {
            $table->id('activityId');
            $table->unsignedBigInteger('moduleId');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('role_id');
            $table->boolean('voice');
            $table->string('question_type');
            $table->string('correct_answer')->nullable();
            $table->integer('response_count')->nullable();
            $table->string('image')->nullable();
            $table->string('voice_file')->nullable();
            $table->timestamps();

            $table->foreign('moduleId')->references('moduleId')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
