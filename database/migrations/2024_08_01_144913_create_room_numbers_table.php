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
        Schema::create('room_numbers', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_room')->constrained('room_types')->cascadeOnDelete();
            $table->string('room_number_name');
            $table->text('description')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_numbers');
    }
};
