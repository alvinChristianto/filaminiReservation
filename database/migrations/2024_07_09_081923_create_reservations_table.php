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
        Schema::create('reservations', function (Blueprint $table) {
            $table->string('id');
            // $table->string('token_reservation');
            $table->foreignId('id_room')->constrained('room_types')->cascadeOnDelete();
            $table->enum('type_reservation', ['RESERVATION', 'OTA', 'WALKIN'])->nullable();
            $table->enum('payment_status', ['UNPAID', 'UNPAID_BOOKED', 'PAID', 'EXPIRED']);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->text('address')->nullable();
            $table->string('image_identity')->nullable();
            $table->boolean('is_hour_reservation');
            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();
            $table->integer('durations')->nullable();
            $table->integer('room_count')->nullable();
            $table->unsignedInteger('price')->nullable();
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
