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
            $table->string('title');
            $table->string('description');
            $table->string('role');
            $table->string('questiontype');
            $table->string('answertype');
            $table->string('voiceredaction');
            $table->integer('numberOfResponses');
            $table->string('answers');
            $table->unsignedBigInteger('moduleId');
            $table->foreign('moduleId')->references('moduleId')->on('modules');
            $table->timestamps();
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
