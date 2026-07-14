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

            $table->unsignedBigInteger('user_id');

            $table->string('space_name',100);

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->unique(['user_id','space_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};