<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pomodoro_lists', function (Blueprint $table) {

            $table->id('pomodoro_list_id');

            $table->unsignedBigInteger('space_id')->unique();

            $table->string('list_name',100)
                  ->default('Pomodoro Timer');

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('space_id')
                  ->references('space_id')
                  ->on('spaces')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pomodoro_lists');
    }
};