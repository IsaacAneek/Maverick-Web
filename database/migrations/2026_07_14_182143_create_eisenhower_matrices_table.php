<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eisenhower_matrices', function (Blueprint $table) {

            $table->id('eisenhower_matrix_id');

            $table->unsignedBigInteger('space_id')->unique();

            $table->string('matrix_name',100)
                  ->default('Eisenhower Matrix');

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('space_id')
                  ->references('space_id')
                  ->on('spaces')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eisenhower_matrices');
    }
};