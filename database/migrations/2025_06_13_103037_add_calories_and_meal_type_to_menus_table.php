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
        Schema::table('menus', function (Blueprint $table) {
            // Tambahkan kolom 'calories' dengan default 0
            $table->integer('calories')->default(0)->after('slug');
            // Tambahkan kolom 'meal_type' yang bisa kosong
            $table->string('meal_type')->nullable()->after('calories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Saat rollback, hapus kolom 'meal_type' dan 'calories'
            $table->dropColumn('meal_type');
            $table->dropColumn('calories');
        });
    }
};