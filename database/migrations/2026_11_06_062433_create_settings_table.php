<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('LuxeEstate Living');
            $table->string('contact_email')->default('support@luxeestate.com');
            $table->string('contact_phone')->default('+1 (800) 555-LUXE');
            $table->string('address')->default('450 Park Avenue, Suite 1200, New York, NY'); // text er bodle string korlam
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('settings'); }
};