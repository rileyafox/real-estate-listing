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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);  // You might want a decimal for price instead of an integer
            $table->string('location');
            $table->unsignedTinyInteger('bedrooms'); // assuming you won't have more than 255 bedrooms
            $table->unsignedTinyInteger('bathrooms'); // similar reasoning as bedrooms
            $table->unsignedTinyInteger('garage')->nullable(); // nullable in case some listings don't have a garage
            $table->unsignedInteger('sqft'); // square footage
            $table->decimal('lot_size', 8, 2); // size of the lot, decimal for precision
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
