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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('identity_number')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->enum('age', ['Muda', 'Dewasa', 'Tua']);
            $table->string('occupation')->nullable(); 
            $table->text('address')->nullable(); 
            $table->enum('domicile', ['Dalam Kota', 'Luar Kota']); 
            $table->string('guarantor')->nullable()->default('Tidak Ada');
            $table->string('source')->nullable(); 
            $table->string('guarantee')->nullable(); 
            $table->enum('track_record', [
                'Baru', 
                'Pernah (Tepat Waktu)', 
                'Pernah (Telat)'
            ])->default('Baru'); 
            
            $table->string('classification_result')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};