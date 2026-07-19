<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {

            $table->id('space_id');

            $table->string('username', 100);

            $table->string('space_name', 100);

            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->unique(['username', 'space_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};