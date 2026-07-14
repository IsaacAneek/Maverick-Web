<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kanban_boards', function (Blueprint $table) {

            $table->id('kanban_board_id');

            $table->unsignedBigInteger('space_id')->unique();

            $table->string('board_name',100)->default('Kanban Board');

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('space_id')
                  ->references('space_id')
                  ->on('spaces')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kanban_boards');
    }
};