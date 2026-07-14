<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eisenhower_tasks', function (Blueprint $table) {

            $table->id('eisenhower_task_id');

            $table->unsignedBigInteger('eisenhower_matrix_id');

            $table->string('task_name');

            $table->enum('quadrant',[
                'important',
                'not_important',
                'urgent',
                'not_urgent'
            ]);

            $table->timestamp('deadline')->nullable();

            $table->boolean('is_completed')->default(false);

            $table->integer('position')->default(0);

            $table->timestamps();

            $table->foreign('eisenhower_matrix_id')
                  ->references('eisenhower_matrix_id')
                  ->on('eisenhower_matrices')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eisenhower_tasks');
    }
};