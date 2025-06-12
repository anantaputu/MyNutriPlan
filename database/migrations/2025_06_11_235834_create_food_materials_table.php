<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('food_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('calories', 8, 2)->default(0); // Kalori
            $table->decimal('protein', 8, 2)->default(0); // Protein
            $table->decimal('fat', 8, 2)->default(0); // Lemak
            $table->decimal('carbohydrates', 8, 2)->default(0); // Karbohidrat
            $table->decimal('fiber', 8, 2)->default(0)->nullable(); // Serat
            $table->string('vitamins')->nullable();
            $table->string('minerals')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('food_materials'); }
};