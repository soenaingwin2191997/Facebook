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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('work')->nullable();
            $table->string('education')->nullable();
            $table->string('address')->nullable();
            $table->string('live')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
