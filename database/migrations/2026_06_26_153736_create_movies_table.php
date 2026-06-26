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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('release_date')->nullable();
            $table->string('classification')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->decimal('rating', 5, 1)->default(0);
            $table->integer('total_rating_people')->default(0);
            $table->text('synopsis')->nullable();
            $table->string('casts')->nullable();
            $table->string('director')->nullable();
            $table->string('writers')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('trailer_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
