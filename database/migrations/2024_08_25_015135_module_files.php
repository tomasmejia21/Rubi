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
        Schema::create('module_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('file_url');
            $table->unsignedBigInteger("moduleId");
            $table->foreign("moduleId")->references("moduleId")->on("modules");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
