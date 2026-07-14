<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kanban_tasks', function (Blueprint $table) {

            $table->id('kanban_task_id');

            $table->unsignedBigInteger('kanban_board_id');

            $table->string('task_name');

            $table->enum('column_name',[
                'todo',
                'ongoing',
                'done'
            ]);

            $table->timestamp('deadline')->nullable();

            $table->boolean('is_completed')->default(false);

            $table->integer('position')->default(0);

            $table->timestamps();

            $table->foreign('kanban_board_id')
                  ->references('kanban_board_id')
                  ->on('kanban_boards')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kanban_tasks');
    }
};