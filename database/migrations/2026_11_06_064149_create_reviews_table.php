<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->string('client_name');
            $table->string('client_role')->default('Property Buyer'); // e.g., Homeowner, Investor, Buyer
            $table->string('client_image')->nullable();
            $table->integer('rating')->default(5); // 1 to 5 Stars
            $table->text('comment');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reviews');
    }
};