<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->decimal('price', 15, 2);
            $table->string('location');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->decimal('area_sqft', 10, 2)->nullable();
            $table->text('description');
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('Available'); // Available, Sold, Rented
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('properties'); }
};