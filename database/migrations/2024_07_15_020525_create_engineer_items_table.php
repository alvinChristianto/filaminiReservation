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
        Schema::create('engineer_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('stock');
            $table->unsignedInteger('base_price');
            $table->integer('percent_increase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engineer_items');
    }
};
