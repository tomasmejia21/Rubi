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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->foreignId('activityId');
            $table->bigInteger('userId');
            $table->primary(['activityId', 'userId']);
            $table->foreign('activityId')->references('activityId')->on('activities');
            $table->foreign('userId')->references('userId')->on('users');
            $table->integer('score')->nullable();
            $table->String('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
