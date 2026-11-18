<?php

use App\Enums\KategoriProduk;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merek_id')->constrained('merek')->restrictOnDelete();
            $table->string('nama', 255);
            $table->enum('kategori', KategoriProduk::values());
            $table->text('deskripsi')->nullable(); // Berisi deskripsi sekaligus spesifikasi produk
            $table->string('gambar', 255)->nullable(); // Path file gambar di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
