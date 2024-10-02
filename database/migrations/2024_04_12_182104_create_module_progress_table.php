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
            $table->bigInteger('userId');
            $table->Integer('progress');
            $table->Integer('grade')->nullable();
            $table->timestamps();
            // Llave primaria compuesta
            $table->primary(['moduleId', 'userId']);
            // Llaves foráneas
            $table->foreign('moduleId')->references('moduleId')->on('modules');
            $table->foreign('userId')->references('userId')->on('users');
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
