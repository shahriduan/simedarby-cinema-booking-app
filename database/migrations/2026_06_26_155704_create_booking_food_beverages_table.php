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
        Schema::create('booking_food_beverages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->foreignId('fnb_id')->nullable()->index();
            $table->string('name');
            $table->string('description');
            $table->string('category')->index();
            $table->decimal('unit_price')->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_food_beverages');
    }
};
