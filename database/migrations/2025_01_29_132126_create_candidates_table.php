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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vote_id');
            $table->unsignedBigInteger('number_candidate');
            $table->string('name_candidate');
            $table->string('classroom_candidate');
            $table->string('image_candidate')->default('gambar.jpg');
            $table->text('vision');
            $table->text('mission');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();

            $table->foreign('vote_id')->references('id')->on('votes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
