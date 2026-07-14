<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pomodoro_tasks', function (Blueprint $table) {

            $table->id('pomodoro_task_id');

            $table->unsignedBigInteger('pomodoro_list_id');

            $table->string('task_name');

            $table->integer('work_duration_min')->default(25);

            $table->integer('break_duration_min')->default(5);

            $table->integer('sessions_completed')->default(0);

            $table->boolean('is_completed')->default(false);

            $table->integer('position')->default(0);

            $table->timestamps();

            $table->foreign('pomodoro_list_id')
                  ->references('pomodoro_list_id')
                  ->on('pomodoro_lists')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pomodoro_tasks');
    }
};