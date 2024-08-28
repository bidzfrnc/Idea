<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * ideas = varchar 250 char
     * likes = integer 0
     * created_at
     * updated_at
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->contrained()->cascadeOnDelete();
            $table->string('content');
            $table->unsignedInteger('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
