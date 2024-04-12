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
        Schema::create('module_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('moduleId');
            $table->string('username');
            $table->timestamps();
            // Llave primaria compuesta
            $table->primary(['moduleId', 'username']);
            // Llaves foráneas
            $table->foreign('moduleId')->references('moduleId')->on('modules');
            $table->foreign('username')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_progress');
    }
};
