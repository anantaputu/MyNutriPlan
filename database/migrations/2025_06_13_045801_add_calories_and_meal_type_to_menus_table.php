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
            // Tambahkan kolom untuk kalori setelah kolom 'slug'
            $table->integer('calories')->default(0)->after('slug');

            // Tambahkan kolom untuk tipe makan (breakfast, lunch, dinner)
            $table->string('meal_type')->nullable()->after('calories');
            
            // Ganti kolom deskripsi dari string ke text agar lebih panjang
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('calories');
            $table->dropColumn('meal_type');
            $table->string('description')->nullable()->change(); // Kembalikan ke tipe string jika di-rollback
        });
    }
};
