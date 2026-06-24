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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->enum('domicile', ['Dalam Kota', 'Luar Kota']);
            $table->enum('guarantor', ['Ada', 'Tidak Ada']); 
            //$table->enum('track_record', ['Baru', 'Pernah (Tepat Waktu)', 'Pernah (Telat)']); 
            $table->string('source');     
            $table->enum('age', ['Muda', 'Dewasa', 'Tua']);
           // $table->string('occupation')->nullable(); 
            $table->enum('class_label', ['Aman', 'Waspada', 'Bahaya']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
