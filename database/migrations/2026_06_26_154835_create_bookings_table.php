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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('cinema_id')->constrained();
            $table->foreignId('movie_id')->constrained();
            $table->timestamp('movie_start_at');
            $table->timestamp('movie_end_at');
            $table->integer('total_selected_seat')->default(1);
            $table->string('promo_code')->nullable();
            $table->decimal('service_charges')->default(0);
            $table->decimal('discount_price')->default(0);
            $table->decimal('grand_total_price')->default(0);
            $table->enum('booking_status', ['Cart', 'Paid'])->default('Cart');
            $table->timestamp('cart_expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
