<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('police_number')->unique();
            $table->string('engine');
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->enum('status', ['tersedia', 'disewa', 'perbaikan'])->default('tersedia');
            $table->decimal('reduce', 5, 2)->default(0)->comment('Diskon dalam persen');
            $table->decimal('stars', 2, 1)->default(0);
            $table->enum('transmission', ['manual', 'automatic', 'semi-automatic'])->default('manual');
            $table->enum('fuel_type', ['bensin', 'diesel', 'elektrik', 'hybrid'])->default('bensin');
            $table->integer('seats')->default(5);
            $table->integer('doors')->default(4);
            $table->string('category')->nullable();
            $table->json('features')->nullable();
            $table->string('color')->nullable();
            $table->integer('year');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->json('gallery_images')->nullable();
            $table->integer('mileage')->default(0)->comment('Kilometer');
            $table->boolean('available_for_long_term')->default(false);
            $table->integer('minimum_rental_days')->default(1);
            $table->timestamps();
        });        
    }
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};